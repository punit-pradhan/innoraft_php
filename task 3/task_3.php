<html>
 
<body>
    <form action="submit.php" method="POST"  enctype="multipart/form-data" >
        <label for="first_name">enter your first name</label><br>
        <input type="text" name="first_name" class="first_name" required pattern="[a-zA-Z]*" /><br><br>
        <label for="sir_name">enter your last name</label><br>
        <input type="text" name="sir_name" class="last_name" required pattern="[a-zA-Z]*" /><br><br>
        <br><br>
        <label>Your Image File
            <input type="file" name="image" accept="image/*" />
        </label><br><br>
        <label for="marks">Enter Marks:</label>

        <textarea id="marks" name="marks" rows="5" cols="50" style="display:block; color:black"
            placeholder="format English|80" required></textarea>
        <br><br>
        <input type="submit" name="submit_btn" />
    </form>


</body>

</html>