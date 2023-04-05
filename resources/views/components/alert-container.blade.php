<div id="alert-container">
    @foreach($alerts as $alert)
        <x-alert :id="$alert['id']"
                 :title="$alert['title']"
                 :message="$alert['message']"
                 :type="$alert['type']"
                 :timeout="$alert['timeout']"/>
    @endforeach
</div>
