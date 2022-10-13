<?php
return [
    'inputContainer' => '<div class="form-group {{required}}">{{content}}<small class="form-text text-muted">{{help}}</small></div>',
    'inputContainerError' => '<div class="form-group {{required}} error">{{content}}<small class="form-text text-muted">{{help}}</small>{{error}}</div>',
    'error' => '<div class="invalid-field">{{content}}</div>',
    'input' => '<input type="{{type}}" class="form-control" name="{{name}}"{{attrs}} />',
    'nestingLabel' => '{{hidden}}{{input}}<label {{attrs}}>{{text}}</label>',
    'textarea' => '<textarea class="form-control" name="{{name}}"{{attrs}}>{{value}}</textarea>',
    'select' => '<select class="form-select" name="{{name}}"{{attrs}}>{{content}}</select>',
];
