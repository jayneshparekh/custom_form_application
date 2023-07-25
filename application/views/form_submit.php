<!DOCTYPE html>
<html>

<head>
    <title>Submit Form</title>
    <!-- Add Bootstrap CSS from CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Submit Form</h1>
        <form method="post" action="<?= base_url('form/submit/' . $form[0]->form_id) ?>">
            <?php foreach ($form as $formField) : ?>
                <div class="form-group">
                    <label><?= $formField->question ?><?php if ($formField->is_required) : ?><span style="color: red">*</span><?php endif; ?></label>
                        <input type="hidden" name="form_data[question_id][<?= $formField->id ?>]">
                        <input type="hidden" name="form_id" value="<?= $formField->form_id ?>">
                        <?php if ($formField->type === 'textbox') : ?>
                        <input type="text" name="form_data[response][<?= $formField->id ?>]" class="form-control" required>
                    <?php elseif ($formField->type === 'radio') : ?>
                        <?php $options = explode(',', $formField->options); ?>
                        <?php foreach ($options as $option) : ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" name="form_data[response][<?= $formField->id ?>]" value="<?= $option ?>" class="form-check-input" required>
                                    <?= $option ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif ($formField->type === 'checkbox') : ?>
                        <?php $options = explode(',', $formField->options); ?>
                        <?php foreach ($options as $option) : ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="form_data[response][<?= $formField->id ?>][]" value="<?= $option ?>" class="form-check-input">
                                    <?= $option ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif ($formField->type === 'dropdown') : ?>
                        <?php $options = explode(',', $formField->options); ?>
                        <select name="form_data[response][<?= $formField->id ?>]" class="form-control" required>
                            <option value="">Select an option</option>
                            <?php foreach ($options as $option) : ?>
                                <option value="<?= $option ?>"><?= $option ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <input type="submit" value="Submit" class="btn btn-primary mt-3">
        </form>
    </div>

    <!-- Add Bootstrap JS from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
