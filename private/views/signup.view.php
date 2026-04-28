<?php Controller::view('includes/header') ?>
     
        <div class="container-fluid">
            <div class="p-4 mx-auto mr-4 shadow rounded" style="margin-top: 50px; width:100%; max-width: 340px;">
                <h2 class="text-center">My School</h2>
                <img src="<?=ROOT?>/assets/logo.png" class="border border-primary d-block mx-auto rounded-circle" style="width: 100px;">
             <h3>Add User</h3>
             <input type="my-4 form-control" type="firstname" name="firstname" placeholder="FirstName">
             <input type="my-4 form-control" type="lastname" name="lastname" placeholder="LastName">
             <input type="my-4 form-control" type="email" name="email" placeholder="Email">

             <select class="my-4 form-control">
                <option value="">-- Select a Gender --</option>
                <option value="">Male</option>
                <option value="">Female</option>
             </select>

             <select class="my-2 form-control">
                <option value="">-- Select a Rank --</option>
                <option value="student">Student</option>
                <option value="Reception">Reception</option>
                <option value="Lecturer">Lecturer</option>
                <option value="Admin">Admin</option>
                <option value="Super Admin">Super Admin</option>
             </select>

             <input type="my-4 form-control" type="password" name="password" placeholder="Password">
             <input type="my-4 form-control" type="password" name="password2" placeholder="Retype Password">
             <br>
             <button class="my-2 btn btn-primary float-end">Add User</button>
             <button class="my-2 btn btn-primary text-white">Cancel</button>
           </div>
        </div>
        
<?php Controller::view('includes/footer') ?>