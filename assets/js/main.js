jQuery(document).ready(function ($) {
  "use strict";

  // Preloader
  //$(window).on("load", function () {
  //  $("#preloder").delay(2000).fadeOut(500);
  //});

  // Mobile Menu
  $(".hamburger").click(function () {
    $(".mobile-menu").addClass("_active");
    $("body").addClass("_lock");
  });

  $(".mobile-menu__close, .mobile-menu__list li a").click(function () {
    $(".mobile-menu").removeClass("_active");
    $("body").removeClass("_lock");
  });

  // Fixed Navigation
  if ($(window).width() >= 992) {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 600) {
        $(".header").addClass("sticky");
      } else {
        $(".header").removeClass("sticky");
      }
    });
  }

  // Switcher Scroll
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".scroll-up").fadeIn();
    } else {
      $(".scroll-up").fadeOut();
    }
  });

  // Scroll To Top
  $(".scroll-up__link").click(function (e) {
    var anchor = $(this);
    $("html, body")
      .stop()
      .animate(
        {
          scrollTop: $(anchor.attr("href"))?.offset()?.top + 2,
        },
        200,
        "swing"
      );
    e.preventDefault();
  });

  // Scroll For Menu Items
  function onScroll(event) {
    var scrollPos = $(window).scrollTop();
    $(".menu li a").each(function () {
      var currLink = $(this);
      var refElement = $(currLink.attr("href"));
      if (refElement.length) {
        if (
          refElement.position().top <= scrollPos &&
          refElement.position().top + refElement.height() > scrollPos
        ) {
          $(".menu li a").removeClass("_active");
          currLink.addClass("_active");
        } else {
          currLink.removeClass("_active");
        }
      }
    });
  }

  // Scroll By Class
  $(".go_to").click(function () {
    elementClick = $(this).attr("href");
    destination = $(elementClick).offset().top;
    $("body,html").animate({ scrollTop: destination }, 900);
  });

  $(window).on("scroll", onScroll);

  $('.header > a[href^="#"]').click(function (e) {
    e.preventDefault();
    $(window).off("scroll");

    $("a").each(function () {
      $(this).removeClass("_active");
    });
    $(this).addClass("_active");

    var target = this.hash;
    var $target = $(target);
    $("html, body")
      .stop()
      .animate(
        {
          scrollTop: $target?.offset()?.top + 2,
        },
        500,
        "swing",
        function () {
          window.location.hash = target;
          $(window).on("scroll", onScroll);
        }
      );
  });

  // Modal Window
  $(".sign-in-open").click(function () {
    $(".popup_sign-in").addClass("_active");
  });

  const popuplist = [
    ".popup_sign-in",
    ".popup_sign-up",
    ".popup_reset",
    ".popup_subscribe",
  ];

  function closedPopups(popuplist) {
    popuplist.forEach((popup) => {
      $(popup).removeClass("_active");
    });
  }

  $(".popup__overlay, .popup__close").click(function () {
    closedPopups(popuplist);
  });

  $(".sign-in__right").click(function () {
    $(".popup_sign-in").removeClass("_active");
    setTimeout(function () {
      $(".popup_sign-up").addClass("_active");
    }, 500);
  });

  $(".sign-up__right").click(function () {
    $(".popup_sign-up").removeClass("_active");
    setTimeout(function () {
      $(".popup_sign-in").addClass("_active");
    }, 500);
  });

  $(".js-form__forgot").click(function () {
    $(".popup_sign-in").removeClass("_active");
    setTimeout(function () {
      $(".popup_reset").addClass("_active");
    }, 500);
  });

  $(".ft-subscribe__btn").click(function () {
    $(".popup_subscribe").addClass("_active");
  });

  // Particles JS
  if ($("*").is("#particles-js")) {
    particlesJS("particles-js", {
      particles: {
        number: {
          value: 110,
          density: {
            enable: true,
            value_area: 1000,
          },
        },
        color: {
          value: ["#fff", "#fff", "#fff", "#fff"],
        },
        shape: {
          type: "circle",
          stroke: {
            width: 0,
            color: "#fff",
          },
          polygon: {
            nb_sides: 5,
          },
          image: {
            src: "img/github.svg",
            width: 100,
            height: 100,
          },
        },
        opacity: {
          value: 0.6,
          random: false,
          anim: {
            enable: false,
            speed: 1,
            opacity_min: 0.1,
            sync: false,
          },
        },
        size: {
          value: 2,
          random: true,
          anim: {
            enable: false,
            speed: 40,
            size_min: 0.1,
            sync: false,
          },
        },
        line_linked: {
          enable: true,
          distance: 120,
          color: "#bbb0b0",
          opacity: 0.4,
          width: 1,
        },
      },
      interactivity: {
        detect_on: "canvas",
        events: {
          onhover: {
            enable: true,
            mode: "grab",
          },
          onclick: {
            enable: false,
          },
          resize: true,
        },
        modes: {
          grab: {
            distance: 140,
            line_linked: {
              opacity: 1,
            },
          },
          bubble: {
            distance: 400,
            size: 40,
            duration: 2,
            opacity: 8,
            speed: 3,
          },
          repulse: {
            distance: 200,
            duration: 0.4,
          },
          push: {
            particles_nb: 4,
          },
          remove: {
            particles_nb: 2,
          },
        },
      },
      retina_detect: true,
    });
  }

  // WOW Animation When You Scroll
  if ($("*").is(".wow")) {
    var wow = new WOW({
      animateClass: "animate__animated",
      mobile: false,
    });
    wow.init();
  }

  // Parallax Mouse
  if ($("*").is("#scene")) {
    var parallaxInstance = new Parallax(document.getElementById("scene"), {
      relativeInput: true,
    });
  }

  // Settings For Blog Slider
  if ($("*").is(".blog-slider")) {
    $(".blog-slider").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: false,
      dots: true,
      responsive: [
        {
          breakpoint: 1199.98,
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 991.98,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 767.98,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });
  }

  // Settings For Graphic
  if ($("*").is(".graphic")) {
    $(".graphic").listtopie({
      size: "auto",
      drawType: "simple",
      strokeWidth: 0,
      hoverEvent: true,
      hoverBorderColor: "#fff",
      hoverWidth: 8,
      fontFamily: "Cabin",
      fontWeight: "400",
      textSize: "16",
      marginCenter: 60,
      listVal: true,
      strokeColor: "#fff",
      listValMouseOver: true,
      infoText: true,
      textColor: "#fff",
      setValues: true,
      listValInsertClass: "graphic_list",
      backColorOpacity: "1",
      hoverSectorColor: true,
      usePercent: true,
    });
  }

  // Accordion
  $(".faq__header").click(function (e) {
    e.preventDefault();
    var item = $(this).closest(".faq__item"),
      dropDown = $(this).closest(".faq__item").find(".faq__content");
    $(this).closest(".faq").find(".faq__content").not(dropDown).slideUp();

    if ($(this).hasClass("_active")) {
      $(this).removeClass("_active");
      item.removeClass("_active");
    } else {
      $(this)
        .closest(".faq")
        .find(".faq__header._active, .faq__item._active")
        .removeClass("_active");
      $(this).addClass("_active");
      item.addClass("_active");
    }

    dropDown.stop(false, true).slideToggle();
  });
});

$(document).ready(function () {
  $("[data-submit]").on("click", function (e) {
    e.preventDefault();
    $(this).closest("form").submit();
  });
  $.validator.addMethod(
    "regex",
    function (value, element, regexp) {
      var re = new RegExp(regexp);
      return this.optional(element) || re.test(value);
    },
    "Please check your input."
  );

  function valEl(el) {
    el.validate({
      rules: {
        subscribe_email: {
          required: true,
          email: true,
        },
      },
      messages: {
        subscribe_email: {
          required: "Required field",
          email: "Invalid email format",
        },
      },

      submitHandler: function (form) {
        var $form = $(form);
        var $formId = $(form).attr("id");
        switch ($formId) {
          case "goToNewPage":
            $.ajax({
              type: "POST",
              url: $form.attr("action"),
              data: $form.serialize(),
            }).always(function (response) {
              location.href = "https://";

              ga("send", "event", "masterklass7", "register");
              yaCounter27714603.reachGoal("lm17lead");
            });
            break;

          case "popupResult":
            $.ajax({
              type: "POST",
              url: $form.attr("action"),
              data: $form.serialize(),
            }).always(function (response) {
              setTimeout(function () {
                $("input, textarea").removeClass("error valid");
                $form.trigger("reset");
              }, 800);
            });
            $(".popup_subscribe").removeClass("_active");
            break;
        }
        return false;
      },
    });
  }

  $(".js-form").each(function () {
    valEl($(this));
  });
});
