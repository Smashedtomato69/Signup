<form action="" method="get">
      <label for="name">Name</label>
      <input type="text" id="name" name="name">
      <input type="submit" value="submit" id="submit">
      <p class ="name" id = "nameresult"> Display NAME  Result here... </p>

    </form>
    <script type = "text/javascript">
        const name = document.getElementById('name'); 
        const displayname = document.getElementById('nameresult'); 
function display (){
    displayname.innerHTML = name.value;
    
}
sub.addEventListener('click', display);

    function MyFormValidator(form) {
        name.innerHTML = name.value;
    this.form = form;
    this._errors = [];
}

MyFormValidator.prototype = {
    constructor: MyFormValidator,

    validate: function () {
        var errors = this._errors,
            name = this._valueOf('name');

        //clear previous errors
        errors.length = 0;

        if (this._isEmpty(name)) {
            errors.push('The name is mandatory');
        }

        return !errors.length;
    },

    errors: function () { return this._errors.slice() },

    _valueOf: function (fieldName) {
        return this.form.querySelector('[name="' + fieldName + '"]').value;
    },

    _isEmpty: function (value) {
        return value == "" || value.length < 1 || value == null;
    }
};

//Setting up form validation
var form = document.querySelector('form'),
    validator = new MyFormValidator(form);

form.addEventListener('submit', function (e) {
    if (!validator.validate()) {
        e.preventDefault(); //prevent submit
        alert(validator.errors());
    }
});
</script>