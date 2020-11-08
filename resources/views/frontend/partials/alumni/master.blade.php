

    <div class="single-point">
        <table class="table" id="Master--target">
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