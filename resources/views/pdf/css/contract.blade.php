<style>

        /* arabic */
@font-face {
  font-family: 'Cairo';
  font-style: normal;
  font-weight: 200;
  font-display: swap;
  src: local('Cairo ExtraLight'), local('Cairo-ExtraLight'), url(https://fonts.gstatic.com/s/cairo/v9/SLXLc1nY6Hkvalrub46O59ZMaA.woff2) format('woff2');
  unicode-range: U+0600-06FF, U+200C-200E, U+2010-2011, U+204F, U+2E41, U+FB50-FDFF, U+FE80-FEFC;
}
/* latin-ext */
@font-face {
  font-family: 'Cairo';
  font-style: normal;
  font-weight: 200;
  font-display: swap;
  src: local('Cairo ExtraLight'), local('Cairo-ExtraLight'), url(https://fonts.gstatic.com/s/cairo/v9/SLXLc1nY6Hkvalrub46F59ZMaA.woff2) format('woff2');
  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Cairo';
  font-style: normal;
  font-weight: 200;
  font-display: swap;
  src: local('Cairo ExtraLight'), local('Cairo-ExtraLight'), url(https://fonts.gstatic.com/s/cairo/v9/SLXLc1nY6Hkvalrub46L59Y.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
body{
    font-family: 'Cairo', sans-serif;
}
.page-break {
  page-break-after: always;
}

.page-before {
  page-break-before: always;
}

.main-color {
  color: #EC2028;
}

.main-color-dark {
  color: #333;
}

.main-bg {
  background-color: #EC2028;
}

.main-bg-dark {
  background-color: #333;
}

@page {
  header: page-header;
  footer: page-footer;
  margin: 1cm;
}

body {
  font-family: "XB Riyaz", sans-serif;
  font-size: 13px;
}

.separator-margin-10 {
  margin-top: 10px;
  margin-bottom: 10px;
}

.separator-margin-20 {
  margin-top: 20px;
  margin-bottom: 20px;
}

.separator-margin-30 {
  margin-top: 30px;
  margin-bottom: 30px;
}

.separator-margin-40 {
  margin-top: 40px;
  margin-bottom: 40px;
}

.separator-margin-50 {
  margin-top: 50px;
  margin-bottom: 50px;
}

.separator-margin-60 {
  margin-top: 60px;
  margin-bottom: 60px;
}

.separator-margin-70 {
  margin-top: 70px;
  margin-bottom: 70px;
}

.separator-margin-80 {
  margin-top: 80px;
  margin-bottom: 80px;
}

.separator-margin-90 {
  margin-top: 90px;
  margin-bottom: 90px;
}

.separator-margin-100 {
  margin-top: 100px;
  margin-bottom: 100px;
}

.border-center {
  border-top: 1px solid #BBB;
}

.clear {
  clear: both;
  display: block;
  overflow: hidden;
}

.f-left {
  float: left !important;
}

.f-right {
  float: right !important;
}

.ltr {
  direction: ltr !important;
}

.rtl {
  direction: rtl !important;
}

.line {
  line-height: 1.5;
}

.line b {
  color: #333;
  font-size: 110%;
}

.line .line-number {
  color: #EC2028;
  font-weight: bold;
}

.bold {
  font-weight: bold;
}

.mark-red {
  color: #cf1938 !important;
}

.text-center {
  text-align: center !important;
}

.title-center {
  font-size: 17px !important;
  margin-bottom: 5px;
}

.page-header {
  height: 60px;
}

.page-header .pdf-title {
  width: 30%;
  float: right;
}

.page-header .pdf-title .title {
  font-size: 23px;
  line-height: 50px;
  margin: 0;
  display: inline-block;
  color: #333;
  border-bottom: 2px solid #333;
  padding: 0 10px;
  border-radius: 4px;
  font-weight: bold;
}

.page-header .pdf-title .line a {
  color: #444;
  text-decoration: none;
}

.page-header .logo {
  width: 40%;
  float: left;
}

body {
  direction: rtl;
  text-align: right !important;
  color: #333;
}

.page-header {
  border-bottom: 1px solid #333;
  padding-bottom: 10px;
}

.page-header .pdf-title {
  float: right;
  text-align: left;
  color: #000;
  width: 150px;
}

.footer {
  text-align: center;
}

.footer .signature {
  width: 50%;
}

.footer .signature .signature-place {
  line-height: 2;
}

.wrapper-content {
  margin-top: 5px;
  padding: 10px;
}

.wrapper-content .content {
  z-index: 2;
}

.wrapper-content .content .page-title {
  direction: ltr;
  text-align: left;
  color: #000;
  font-size: 24px;
  margin-bottom: 0;
  letter-spacing: 1px;
  margin-top: 0;
}

.wrapper-content .content .page-title .label-page {
  display: inline-block;
  font-size: 30px;
}

.wrapper-content .content .introduction .line.title {
  margin-top: 10px;
}

.wrapper-content .content .introduction .line.title .text {
  font-size: 20px;
  color: #EC2028;
}

.header-content .date-into {
  width: 79%;
}

.header-content .contract-number {
  width: 16%;
  text-align: left;
  padding: 0 2%;
  font-weight: bold;
  color: #333;
  font-size: 26px;
}

.header-content .wrapper-header-content {
  margin-top: 5px;
}

.header-content .first-part,
.header-content .second-part {
  float: right !important;
  width: 47%;
}

.header-content .first-part .wrapper-part,
.header-content .second-part .wrapper-part {
  padding: 0;
}

.header-content .first-part .part-title,
.header-content .second-part .part-title {
  margin-top: 10px;
  margin-bottom: 3px;
}

.header-content .first-part .part-title .text,
.header-content .second-part .part-title .text {
  color: #EC2028;
}

.services {
  direction: ltr;
  text-align: left;
  margin-top: 20px;
  margin-bottom: 10px;
}

.services .custom-table {
  font-size: 13px;
  border-top: 2px solid #333;
  border-bottom: 2px solid #333;
}

.services .custom-table .side {
  width: 35%;
  float: left;
  padding: 4px 5px;
  color: #222;
}

.services .custom-table .side.price {
  width: 25%;
  text-align: right;
}

.services .custom-table .head .row {
  border-bottom: 2px solid #333;
}

.services .custom-table .head .side {
  color: #222;
  font-weight: bold;
  color: #EC2028;
  text-transform: uppercase;
  font-size: 14px;
}

.services .custom-table .body {
  padding-bottom: 7px;
}

.services .custom-table .body .row.active {
  border-bottom: 1px solid #DDD;
}

.services .custom-table .body .side .amount {
  font-weight: bold;
  color: #333;
}

.services .payments {
  overflow: hidden;
  margin-top: 10px;
}

.services .payments .wrapper-payments {
  float: right;
  width: 45%;
  border-bottom: 2px solid #333;
  padding-bottom: 5px;
}

.services .payments .wrapper-payments .row {
  margin: 3px 0;
}

.services .payments .wrapper-payments .row .side {
  float: left;
  text-align: right;
  width: 30%;
  padding-right: 2%;
}

.services .payments .wrapper-payments .row .side.title {
  padding: 0;
  width: 67%;
  color: #EC2028;
  font-weight: bold;
  text-align: left;
}

.services .payments .wrapper-payments .row .side .price {
  font-weight: bold;
}

.services .payments .wrapper-payments .row.row-services-amount {
  border-bottom: 1px solid #000;
  padding-bottom: 3px;
  margin-bottom: 3px;
}

.services .payments .wrapper-payments .row.row-paid-amount .side.title {
  color: #333;
  font-style: italic;
}

.terms {
  border-bottom: 2px solid #333;
  font-size: 11px;
  margin-top: 15px;
  margin-bottom: 15px;
  padding-top: 5px;
  padding-bottom: 5px;
}

.terms .title-center {
  font-size: 18px;
  color: #333;
  margin-bottom: 10px;
  text-align: center;
}


/*# sourceMappingURL=contract.css.map*/

</style>