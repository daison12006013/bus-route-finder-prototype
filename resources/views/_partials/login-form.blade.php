<form method="POST" action="{{ route('bus-router-sg::login-attempt') }}">
    {{ csrf_field() }}
    <h5>Login</h5>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="text" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="password" name="password">
            </div>
        </div>
    </div>

    <button type="submit" name="submit" class="btn btn-success btn-block">Login</button>
</form>
