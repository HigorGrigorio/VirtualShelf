<?php

namespace App\Domain\UseCases\Base;

use App\Core\Logic\Maybe;
use App\Core\Logic\Result;
use App\Domain\UseCases\UseCase;
use App\Http\Database\Contracts\IRepository;
use App\Presentation\Adapters\Excel\FromCollectionAdapter;
use App\Presentation\Adapters\Excel\FromViewAdapter;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class ExportRecord extends UseCase
{

    public function __construct(IRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @throws Exception
     */
    public function execute(): Result
    {
        try {
            $args = $this->getArgs();

            if ($args['columns'] === null) {
                throw new Exception('the columns of table is required');
            }

            if ($args['format'] === null) {
                throw new Exception('An format is required');
            }

            if ($args['filename'] === null) {
                throw new Exception('An filename is required');
            }

            $format = $args['format'];

            if (!in_array($format, ['xlsx', 'csv', 'pdf'])) {
                throw new Exception(`Format ${$format} is not supported`);
            }

            $exportResult = $this->getRepository()->export($args['columns']);

            // When the array is empty, return a reject result.
            if ($exportResult->isNothing()) {
                // No records to export. Notify the user that does not have records to export.
                $return = Result::reject($exportResult, 'Do not have records to export');
            } else {
                // parse array to a collection
                $collection = collect($exportResult->get());

                if ($format === 'pdf' && $args['view'] === null) {
                    throw new Exception('A view is required to export to pdf');
                }

                $export = match ($format) {
                    'xlsx', 'csv' => Excel::download(
                        FromCollectionAdapter::adapt([$collection]),
                        $args['filename'] . '.' . $format
                    ),
                    'pdf' => Excel::download(
                        FromViewAdapter::adapt([
                            $args['view']['name'],
                            array_merge(
                                [
                                    'collection' => $collection,
                                    'columns' => $args['columns'],
                                ],
                                $args['view']
                            )
                        ]),
                        $args['filename'] . '.' . $format
                    ),
                    // for security reasons.
                    default => throw new Exception('Format not supported')
                };

                $return = Result::accept(Maybe::just($export), 'Records exported successfully');
            }
        } catch (Exception $e) {
            $return = Result::from($e);
        }

        return $return;
    }
}
