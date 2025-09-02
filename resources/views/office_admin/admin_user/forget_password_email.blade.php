@extends('../../master')
@section('body')
    <div class="container" style="margin-top: 50px; margin-bottom: 60px;">
        <div class="row my-4">
            <div class="col-md-6 offset-md-3">
                 <h4 style="text-align: center">StudyLearn Admin Forget Password</h4>
                 <div style="text-align: center">
                    <p><b>Note:</b> Password forget link will be sent to registered email. </p>
                 </div>
                    <form action="{{route('admin-forget-password')}}">
                        @csrf
                        <input type="hidden" name="admin_forget_password" value="admin_forget_password">
                        <div class="form-group">
                            <label for="">Email:</label>
                            <input type="email" class="form-control" name="email"
                                placeholder="Enter email" required 
                                style="border: 1px solid grey;"
                                >
                                <small class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </small>
                        </div> 
                        <br>
                        <div style="text-align: end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                 </div>
                <br>
            </div>
        </div>
    </div>
@endsection
@section('script-and-files')

@endsection