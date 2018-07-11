<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management System</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styles.css">
</head>
<body>

<div class="container">
    <?php if($errorMsg){ ?>
        <div class="box-body">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="this.parentElement.style.display='none';">×</button>
                <?php echo $errorMsg;?>
            </div>
        </div>
    <?php } ?>

    <?php if($successMsg) { ?>
        <div class="box-body">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="this.parentElement.style.display='none';">×</button>
                <?php echo $successMsg;?>
            </div>
        </div>
    <?php } ?>
    <div class="container-title text-center"><img src="assets/images/group_ico.png"> Student Management System</div>
    <div class="form-wrapper">
        <form action="<?php echo BASE_URL; ?>student/save" method="post">
            <div>
                <label for="fname">First Name</label>
                <input type="text" id="firstname" name="firstname" />
            </div>
            <div>
                <label for="lname">Last Name</label>
                <input type="text" id="lastname" name="lastname" />
            </div>
            <div>
                <label for="subjects">Subjects</label>
                <select multiple name="subjects[]" id="subject" class="input-multi">
                    <?php if(count($subjects) > 0) : ?>
                        <?php foreach ($subjects as $subject) : ?>
                            <option value="<?php echo $subject['subject_id'];?>"><?php echo $subject['subject'];?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div>
                <input type="submit" name="save-student" value="Save" />
            </div>
        </form>
    </div>
    <div style="clear: both;"></div>
    <div class="data-wrapper">
        <h2>Students List</h2>
        <table id="students">
            <thead>
            <tr>
                <th style="width: 30%;">First Name</th>
                <th style="width: 30%;">Last Name</th>
                <th style="width: 40%;">Subjects</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (is_array($students) && count($students) > 0) :
                foreach ($students as $student) :
                    ?>
                    <tr class="text-center">
                        <td><?php echo $student['first_name']; ?></td>
                        <td><?php echo $student['last_name']; ?></td>
                        <td><?php echo $student['subjects']; ?></td>
                    </tr>
                    <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="4" class="text-center text-red">No records found.</td>
                </tr>
                <?php
            endif;
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>