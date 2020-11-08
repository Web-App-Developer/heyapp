

    <div class="single-point">
        <table class="table">
            <tr class="text-center">
                <th colspan="2"><h5 class="block--divider">Master</h5></th>
            </tr>
            <tr>
                <td class="left--col">Master Name</td>
                <td class="right--col">
                    <select name="master_name" class="form-control">
                        <option value="MEBA">MEBA</option>
                        <option value="MEGA">MEGA</option>
                        <option value="MEBW">MEBW</option>
                        <option value="IMBA">IMBA</option>
                        <option value="MDBI">MDBI</option>
                        <option value="Energy MBA">Energy MBA</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td class="left--col">Year</td>
                <td class="right--col">
                    <select name="year" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </td>
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