$(document).ready(function(e){var t=$("#main-select");t.click(function(e){var a=t.prop("checked");console.log(a);var c=$(".check");for(let r of c)$(r).prop("checked",a),!1!=a?$(r).parent().parent().addClass("selected"):$(r).parent().parent().removeClass("selected")}),$(".check").click(function(e){!1!=$(e.target).prop("checked")?$(e.target).parent().parent().addClass("selected"):$(e.target).parent().parent().removeClass("selected")})});