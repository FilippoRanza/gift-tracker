
<span>
    <input type="password" oninput="check_password();" id="password-field" required="required" name="password" class="form-control" placeholder="{{ __('set_password.new-password') }}">
    <br>
    <div>
        <p>La password deve contenere almeno un numero, una lettera ...</p>
    </div>
    <br>
    <div class="password-strength">
        <span id="box-1" class="strength-block block-1"></span>
        <span id="box-2" class="strength-block block-2"></span>
        <span id="box-3" class="strength-block block-3"></span>
        <span id="box-4" class="strength-block block-4"></span>
        <span id="box-5" class="strength-block block-5"></span>
    </div>

    <br>
    <input type="password" required="required" oninput="compare_password();" name="confirm" class="form-control input" id="confirm-field"  placeholder="{{ __('set_password.confirm-password') }}">
    <br>
</span>
<script src="{{ URL::to('/') }}/static/scripts/validate_new_password.js"></script>

