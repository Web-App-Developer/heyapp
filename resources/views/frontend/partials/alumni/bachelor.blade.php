

    <div class="single-point">
        <table class="table" id="Bachelor--target">
            <tr class="text-center">
                <th colspan="2"><h5 class="block--divider">Bachelor</h5></th>
            </tr>
            <tr>
                <td class="left--col">Learning Stream</td>
                <td class="right--col">
                    <select name="learning_stream" class="form-control">
                        <option value="English">English</option>
                        <option value="French">French</option>
                        <option value="German">German</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td class="left--col">Graduation Year</td>
                <td class="right--col">
                    @include('frontend.general.year-list')
                </td>
            </tr>

            <tr>
                <td class="left--col">Email</td>
                <td class="right--col"><input type="email" name="email" class="form-control" placeholder="Email"></td>
            </tr>

            <tr>
                <td class="left--col">Telephone</td>
                <td class="right--col"><input type="tel" name="telephone" class="form-control" placeholder="Telephone"></td>
            </tr>
        </table>
    </div> <!-- .single-point end here -->


    @include('frontend/general/form-bottom')
