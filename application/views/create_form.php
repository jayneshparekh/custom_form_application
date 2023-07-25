<!DOCTYPE html>
<html>

<head>
    <title>Create Custom Form</title>
    <!-- Add Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Create Custom Form</h1>
        <form method="post" action="<?= base_url('form/create_form') ?>">
            <div id="questions">
                <div class="form-group">
                    <label>Question:</label>
                    <input type="text" name="form_data[question][]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Type:</label>
                    <select name="form_data[type][]" class="form-control" required>
                        <option value="">Select a type</option>
                        <option value="textbox">Textbox</option>
                        <option value="radio">Radio Button</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="dropdown">Dropdown</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Options (comma-separated for Dropdown/Radio):</label>
                    <input type="text" name="form_data[options][]" class="form-control">
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" name="form_data[is_required][]" value="1" class="form-check-input">
                    <label class="form-check-label">Required</label>
                </div>
            </div>

            <button type="button" class="btn btn-primary" onclick="addQuestion()">Add Question</button>

            <input type="submit" value="Create Form" class="btn btn-primary">
        </form>
    </div>

    <!-- Add Bootstrap JS from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function addQuestion() {
            var questionsDiv = document.getElementById('questions');

            var questionDiv = document.createElement('div');
            questionDiv.classList.add('form-group');
            questionDiv.innerHTML = `
                <label>Question:</label>
                <input type="text" name="form_data[question][]" class="form-control" required>
            `;

            var typeDiv = document.createElement('div');
            typeDiv.classList.add('form-group');
            typeDiv.innerHTML = `
                <label>Type:</label>
                <select name="form_data[type][]" class="form-control" required>
                    <option value="">Select a type</option>
                    <option value="textbox">Textbox</option>
                    <option value="radio">Radio Button</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="dropdown">Dropdown</option>
                </select>
            `;

            var optionsDiv = document.createElement('div');
            optionsDiv.classList.add('form-group');
            optionsDiv.innerHTML = `
                <label>Options (comma-separated for Dropdown/Radio):</label>
                <input type="text" name="form_data[options][]" class="form-control">
            `;

            var requiredDiv = document.createElement('div');
            requiredDiv.classList.add('form-group', 'form-check');
            requiredDiv.innerHTML = `
                <input type="checkbox" name="form_data[is_required][]" value="1" class="form-check-input">
                <label class="form-check-label">Required</label>
            `;

            questionsDiv.appendChild(questionDiv);
            questionsDiv.appendChild(typeDiv);
            questionsDiv.appendChild(optionsDiv);
            questionsDiv.appendChild(requiredDiv);
        }
    </script>
</body>

</html>
