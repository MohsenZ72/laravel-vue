@extends('users::layouts.master')

<!DOCTYPE html>

        <div id="app"></div>
        @vite('resources/js/app.js')
       
</html>
<script>
        window.users = {users:@json($users),current:@json($current)}
        </script>

