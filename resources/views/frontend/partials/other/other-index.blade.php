<form class="myForm__" id="other--form" action="{{ route('online-requests.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="registration_type" value="Other">
    <div class="single-point">
        <table class="table">
            <tr>
                <td class="left--col">Full Name</td>
                <td class="right--col"><input type="text" name="full_name" class="form-control" placeholder="Full Name"></td>
            </tr>
            <tr>
                <td class="left--col">You are</td>
                <td class="right--col">
                    <select name="you_are" class="form-control">
                        <option value="Applicant">Applicant</option>
                        <option value="Parent">Parent</option>
                        <option value="Partner">Partner</option>
                        <option value="Professor">Professor</option>
                        <option value="Other">Other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="left--col">E-mail</td>
                <td class="right--col"><input type="email" name="email" class="form-control" placeholder="Email"></td>
            </tr>
            <tr>
                <td class="left--col">Telephone</td>
                <td class="right--col"><input type="tel" name="telephone" class="form-control" placeholder="Telephone"></td>
            </tr>
        </table>
    </div> <!-- .single-point end here -->

    @include('frontend/general/form-bottom')

</form>