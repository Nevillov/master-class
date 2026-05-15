# Laravel CI/CD Pipeline

## Project

Master Class Laravel application.

## Pipeline Features

The project uses GitHub Actions CI/CD pipeline.

Pipeline запускается при:
- push
- pull request

Для веток:
- develop
- uat
- main

---

## Test Stage

Pipeline запускает Laravel tests:

```bash
php artisan test --coverage --min=50