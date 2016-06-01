videouploader
=========

###Description
This module allows students to upload a single video into a predefined folder.  The video will overwrite if the student has already uploaded a video
This module is designed to work within the edX platform using the LTi module.

###Usage
- create a "files" directory with full permissions (chmod 777)

1. In the course, go to Settings > Advanced Settings
2. For Policy Key "advanced_modules" add "lti" to the array
3. For Policy Key "lti_passports" add "test:test:12345" to the array
1. Create a new LTi block
2. Set launch URL to "https://tools.ceit.uq.edu.au/videouploader/"
3. Set lti_id to "test"
4. Set custom_parameters:
	- title=My Title				# Title of the block
