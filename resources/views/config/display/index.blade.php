<x-admin>
    <div class="panel panel-primary">
        <div class="panel-heading"><h2>laravel 8 image upload example - ItSolutionStuff.com.com</h2></div>
        <div class="panel-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                <img src="images/{{ Session::get('image') }}">
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('config.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-8">
                    <input type="text" name="greeting" placeholder="Greeting Message" class="w-full rounded-xl text-5xl p-4">

                    <p class="dark:text-white text-3xl py-4">Background Image</p>
                    <input type="file" name="image" class="w-full text-5xl dark:text-white mb-8">

                    <button type="submit" class="bg-green-500 text-5xl p-8 rounded-xl dark:text-white my-8">Save & Upload</button>
                </div>
            </form>

        </div>
    </div>
</x-admin>

