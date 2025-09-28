<?php

function includeTemplate(string $templatePath, array $data =[]) {
    extract($data);
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/' . ltrim($templatePath, '/');
}