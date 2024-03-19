<head>
    
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
  integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>

</head>
<select id="select-to" class="contacts" placeholder="Pick some people..."></select>

<script>
    const REGEX_EMAIL = "([a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@" + "(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)";

$("#select-to").selectize({
  persist: false,
  maxItems: null,
  valueField: "email",
  labelField: "name",
  searchField: ["name", "email"],
  options: [
    { email: "brian@thirdroute.com", name: "Brian Reavis" },
    { email: "nikola@tesla.com", name: "Nikola Tesla" },
    { email: "someone@gmail.com" },
  ],
  render: {
    item: function (item, escape) {
        return (
        "<div>" +
        (item.name
            ? '<span class="name">' + escape(item.name) + "</span>"
            : "") +
        (item.email
            ? '<span class="email">' + escape(item.email) + "</span>"
            : "") +
        "</div>"
        );
    },
    option: function (item, escape) {
        var label = item.name || item.email;
        var caption = item.name ? item.email : null;
        return (
        "<div>" +
        '<span class="label">' +
        escape(label) +
        "</span>" +
        (caption
            ? '<span class="caption">' + escape(caption) + "</span>"
            : "") +
        "</div>"
        );
    },
  },
  createFilter: function (input) {
    var match, regex;

    // email@address.com
    regex = new RegExp("^" + REGEX_EMAIL + "$", "i");
    match = input.match(regex);
    if (match) return !this.options.hasOwnProperty(match[0]);

    // name <email@address.com>
    regex = new RegExp("^([^<]*)<" + REGEX_EMAIL + ">$", "i");
    match = input.match(regex);
    if (match) return !this.options.hasOwnProperty(match[2]);

    return false;
  },
  create: function (input) {
    if (new RegExp("^" + REGEX_EMAIL + "$", "i").test(input)) {
        return { email: input };
    }
    var match = input.match(
        new RegExp("^([^<]*)<" + REGEX_EMAIL + ">$", "i")
    );
    if (match) {
        return {
        email: match[2],
        name: $.trim(match[1]),
        };
    }
    alert("Invalid email address.");
    return false;
  },
});
        
</script>