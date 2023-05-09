<div class="dropdown d-inline">
    <button class="btn btn-ocean dropdown-toggle" type="button" id="dropdown-export"
            data-mdb-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-file-export"></i>
        <span class="ms-2">Export</span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdown-export">
        <li>
            <form method="POST" action="{{route('tables.'.$table.'.export', ['format' => 'csv'])}}">
                @csrf
                <button class="dropdown-item"
                        href="{{route('tables.'.$table.'.export', ['format' => 'csv'])}}">
                    CSV
                </button>
            </form>
        </li>
        <li>
            <form method="POST" action="{{route('tables.'.$table.'.export', ['format' => 'pdf'])}}">
                @csrf
                <button class="dropdown-item"
                        href="{{route('tables.'.$table.'.export', ['format' => 'pdf'])}}">
                    PDF
                </button>
            </form>
        </li>
        <li>
            <form method="POST" action="{{route('tables.'.$table.'.export', ['format' => 'xlsx'])}}">
                @csrf
                <button class="dropdown-item"
                        href="{{route('tables.'.$table.'.export', ['format' => 'xlsx'])}}">
                    XLSX
                </button>
            </form>
        </li>
    </ul>
</div>
