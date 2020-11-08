
    
    <div class="single-point">
        <table class="table">
            <tr>
                <td class="left--col">Full Name</td>
                <td class="right--col"><input getformid="alumni--form--" type="text" class="get_fullNameVal form-control" placeholder="Full Name"></td>
            </tr>
            <tr>
                <td class="left--col">Degree</td>
                <td class="right--col">
                    <select name="degree" getformid="alumni--form--" class="form-control selectOption_">
                        <option value="">Select One</option>
                        <option value="Bachelor">Bachelor</option>
                        <option value="Master">Master</option>
                    </select>
                </td>
            </tr>
        </table>
    </div> <!-- .single-point end here -->

    <form class="myForm__" id="alumni--form--Bachelor" method="POST" enctype="multipart/form-data" action="{{ route('online-requests.store') }}">
        @csrf
        <input type="hidden" name="registration_type" value="Alumni">
        <input type="hidden" name="full_name" value="" class="set_full_name_val">
        <input type="hidden" name="degree" value="Bachelor">
        <div class="wapper_ Bachelor--warpper d-none">
            @include('frontend/partials/alumni/bachelor')
        </div>
    </form>

    <form class="myForm__" id="alumni--form--Master" method="POST" enctype="multipart/form-data" action="{{ route('online-requests.store') }}">
        @csrf
        <input type="hidden" name="registration_type" value="Alumni">
        <input type="hidden" name="full_name" value="" class="set_full_name_val">
        <input type="hidden" name="degree" value="Master">
        <div class="wapper_ Master--warpper d-none">
            @include('frontend/partials/alumni/master')
        </div>
    </form>
    