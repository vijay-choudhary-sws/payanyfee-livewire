
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2 class="py-5">Admin Login Form</h2>

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                @if(Session::has('error-message'))
                    <p class="alert alert-info">{{ Session::get('error-message') }}</p>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email" value="admin@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" value="123123">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Admin Login">
                </form>
            </div>
        </div>
    </div>
