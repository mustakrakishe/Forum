# Forum

## Description
A web application which allows to create and discuss user topics.

## Terms of reference
An application must provide:
- registration (with a phone) + logining (by e-mail/login) with non-page-refresh validation;
- creating, editing, deleting topics with validation (not empty) with non-page-refresh validation and delete confirmation request;
- creating, editing, deleting comments with validation (not empty) with non-page-refresh validation and delete confirmation request;
- viewing of the topics and comments for not registred users;
- comments must have hierarchical structure;
- it must be despalyed 10 last root commments with its nested ones on the page;
- nested comments have a left side tabulation;
- comment must include an author and create date;
- newest comments must be displayed at the first;
- newest topics must be displayed at the first.

## What's new

### 1.2.2
- Topic delete confirmation is added.

### 1.2.1
- Default topic author is case he is deleted.

### 1.2.0
- Topic CRUD is available.

### 1.1.4
- Form submitting by the "enter" is available.

### 1.1.3
- Fix the name saving into phone db field.
- Added highlight of the both field when it is login data does not match any db record.
- Added password confirmation input alert in case of mismatch with the password.

### 1.1.2
- Reorganized js scripts.

### 1.1.1
- Integrated bootstrap styles.
- Styled invalid auth inputs.

### 1.1.0
- Login is available by either login or e-mail.
- Login validation is ajax capabillity.

### 1.0.0
- An authorization is available.
- A registration form ajax validation is organized.