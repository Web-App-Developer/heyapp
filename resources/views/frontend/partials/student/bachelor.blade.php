

    <div class="single-point">
        <table class="table">
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
                <td class="left--col">Year</td>
                <td class="right--col">
                    <select name="year" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3 Suppl">3 Suppl</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td class="left--col">Group</td>
                <td class="right--col"><input type="text" name="group" class="form-control" placeholder="Group"></td>
            </tr>

            <tr>
                <td class="left--col">Email</td>
                <td class="right--col"><input name="email" type="email" class="form-control" placeholder="Email"></td>
            </tr>

            <tr>
                <td class="left--col">Telephone</td>
                <td class="right--col"><input name="telephone" class="form-control" type="tel" placeholder="Telephone"></td>
            </tr>
        </table>
    </div> <!-- .single-point end here -->


    @include('frontend/general/form-bottom')