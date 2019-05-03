<?php
session_start();
if (isset($_SESSION['user'])) {
    include './production/Parts/head.php';
}
?>
<form action="./app/" method="post" name="login">
    <table>
        <input type="hidden" name="form_login">
        <tr>
            <th>
                名前
            </th>
            <td>
                <input type="name" name="name" value="">
            </td>
        </tr>
        <tr>
            <th>
                パスワード
            </th>
            <td>
                <input type="password" name="password" value="">
            </td>
        </tr>
    </table>
    <input type="submit" name="submit" value="ログイン">
</form>