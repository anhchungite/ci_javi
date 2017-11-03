$(document).ready(function () {
    $("#frmLogin").validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            username: {
                required: "Vui lòng nhập user name",
            },
            password: {
                required: "Vui lòng nhập password",
            }
        }
    });
    $("#frm_cat").validate({
        rules: {
            name_cat: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            name_cat: {
                required: "Tên danh mục không được để trống",
                minlength: "Tối thiểu 2 ký tự",
            }
        }
    });
    // Validate bằng biểu thức chính quy
    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        }
    );
    $("#frm_addUser").validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
                maxlength: 32,
                regex: /^[a-z_][a-z0-9_\.\s]{2,31}$/
            },
            password: {
                required: true,
                minlength: 6,
                regex: /^(?=.*\d)(?=.*[A-Z])(?=.*\W).{6,32}$/
            },
            fullname: {
                required: true,
            }
        },
        messages: {
            username: {
                required: "Tên người dùng không được để trống",
                minlength: "Tối thiểu 3 ký tự",
                maxlength: "Tối đa 32 ký tự",
                regex: "Tên đăng nhập không hợp lệ"
            },
            password: {
                required: "Mật khẩu không được để trống",
                minlength: "Mật khẩu tối thiểu 6 ký tự",
                regex: "<ul><li>Tồn tại ít nhất 1 ký tự đặc biệt</li><li>Tồn tại ít nhất 1 ký tự in hoa</li><li>Tồn tại ít nhất 1 ký tự số</li></ul>"
            },
            fullname: {
                required: "Tên đầy đủ không được để trống",
            }
        }
    });
    $("#frm_editUser").validate({
        rules: {
            password: {
                minlength: 6,
                regex: /^(?=.*\d)(?=.*[A-Z])(?=.*\W).{6,32}$/
            },
            fullname: {
                required: true,
            }
        },
        messages: {
            password: {
                minlength: "Mật khẩu tối thiểu 6 ký tự",
                regex: "<ul><li>Tồn tại ít nhất 1 ký tự đặc biệt</li><li>Tồn tại ít nhất 1 ký tự in hoa</li><li>Tồn tại ít nhất 1 ký tự số</li></ul>"
            },
            fullname: {
                required: "Tên đầy đủ không được để trống",
            }
        }
    });

    $("#frm_News").validate({
        ignore: [],
        rules: {
            tentin: {
                required: true,
            },
            danhmuc: {
                required: true,
                min: 1,
            },
            mota: {
                required: true,
                minlength: 50,
                maxlength: 200,
            },
            chitiet: {
                required: function (textarea) {
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorchitiet = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorchitiet.length === 0;
                }
            }
        },
        messages: {
            tentin: {
                required: "Vui lòng nhập tên tin tức",
            },
            danhmuc: {
                required: "Chọn danh mục",
                min: "Chọn danh mục",
            },
            mota: {
                required: "Mô tả không được trống",
                minlength: "Mô tả tối thiểu 50 ký tự",
                maxlength: "Mô tả tối đa 100 ký tự",
            },
            chitiet: {
                required: "Chi tiết không được trống",
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "chitiet") {
                error.insertBefore("textarea#chitiet");
            } else {
                error.insertBefore(element);
            }
        }

        /*        
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "email")
                        error.insertAfter(".some-class");
                    else if (element.attr("name") == "phone")
                        error.insertAfter(".some-other-class");
                    else
                        error.insertAfter(element);

                }
        */
    });
    $("#fcontact").validate({
        ignore: [],
        rules: {
        	HO_VA_TEN: {
                required: true,
                maxlength: 50
            },
            EMAIL: {
                required: true,
                email: true
            },
            PHONE: {
                number: true,
            },
            WEBSITE: {
                url: true,
            },
            CONTENT: {
                required: function (textarea) {
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorCONTENT = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorCONTENT.length === 0;
                }
            }
        },
        messages: {
        	HO_VA_TEN: {
                required: "Vui lòng nhập Họ và Tên",
            },
            EMAIL: {
                required: "Vui lòng nhập Email",
                email: "Vui lòng nhập địa chỉ Email hợp lệ"
            },
            PHONE: {
                number: "Vui lòng nhập Số điện thoại",
            },
            WEBSITE: {
                url: "Vui lòng nhập địa chỉ Website",
            },
            CONTENT: {
                required: "Nội dung không được để trống",
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "CONTENT") {
                error.insertBefore("textarea#CONTENT");
            } else {
                error.insertBefore(element);
            }
        }
    });
});