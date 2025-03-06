# Changelog

All notable changes to `seat-hr` will be documented in this file

## 1.0.0 - 2022-06-08

- initial release

## 1.0.1 - 2022-06-22

- fix route cache issue
- remove binds that were interfering with core seat corporation views
- fix missing lang/trans

## 1.0.2 - 2022-08-15

- fix question id fk violation #3

## 1.0.3 - 2022-12-19

- fix #7 causing errors when attempting to search/sort
- #5 add seat-hr entry to character menu
  - added SeAT Profile button to HR Profile

## 1.0.4 - 2023-07-30

- fix #10 to allow question deletion
- add warning to top level question deletion
- new feature to allow application deletion

## 2.0.0 - 2023-11-09

- @zenobio93 updated for SeAT v5.x compatibility

## 2.0.1 - 2025-01-27

v2.0.1 fixes & v5 switch to master branch

- #17 fix class names inconsistent with other partials
- #18 fix error of deleting user causing application statuses by them to be deleted, creating errors in attempting to query currentStatus
- move SeAT v5 to master branch given stable release

## 2.0.2

- #20 fix Invalid Corp Questions Configuration Options when 2+ Corporations are configured

## 2.0.3 

- #22 fix Error on add question to corporation
