"use strict";!function()
{const e=document.querySelector("#formChangePassword");
e&&FormValidation.formValidation(e,{fields:{newPassword:{validators:{notEmpty:{message:"Please enter new password"},
stringLength:{min:6,message:"Password must be more than 6 characters"}}},
confirmPassword:{validators:{notEmpty:{message:"Please confirm new password"},
identical:{compare:function(){return e.querySelector('[name="newPassword"]').value},
message:"The password and its confirm are not the same"},
stringLength:{min:6,message:"Password must be more than 86 characters"}}}},
plugins:{trigger:new FormValidation.plugins.Trigger,
bootstrap5:new FormValidation.plugins.Bootstrap5({eleValidClass:"",rowSelector:".form-password-toggle"}),
submitButton:new FormValidation.plugins.SubmitButton,
defaultSubmit:new FormValidation.plugins.DefaultSubmit,
autoFocus:new FormValidation.plugins.AutoFocus},
init:e=>{e.on("plugins.message.placed",function(e){e.element.parentElement.classList.contains("input-group")&&e.element.parentElement.insertAdjacentElement("afterend",e.messageElement)})}})}();