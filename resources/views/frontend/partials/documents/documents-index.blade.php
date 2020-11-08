

    <div class="single-point">
        <table class="table">
            <tr>
                <td class="left--col">Full Name2</td>
                <td class="right--col"><input getformid="student--form--" type="text" class="get_fullNameVal form-control" placeholder="Full Name"></td>
            </tr>
            <tr>
                <td class="left--col">Degree2</td>
                <td class="right--col">
                    <select getformid="student--form--" class="form-control selectOption_">
                        <option value="">Select One</option>
                        <option value="Bachelor">Bachelor</option>
                        <option value="Master">Master</option>
                    </select>
                </td>
            </tr>
        </table>
    </div> <!-- .single-point end here -->

    <form class="myForm__" action="{{ route('online-requests.store') }}" method="POST" 
        id="student--form--Bachelor" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="registration_type" value="Student">
        <input type="hidden" name="full_name" value="" class="set_full_name_val">
        <input type="hidden" name="degree" value="Bachelor">
        <div class="wapper_ Bachelor--warpper d-none">
           @include('frontend/partials/student/bachelor') 
        </div>
    </form>

    <form class="myForm__" action="{{ route('online-requests.store') }}" method="POST" 
        id="student--form--Master" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="registration_type" value="Student">
        <input type="hidden" name="full_name" value="" class="set_full_name_val">
        <input type="hidden" name="degree" value="Master">
        <div class="wapper_ Master--warpper d-none">
            @include('frontend/partials/student/master')
        </div>
    </form>


    
