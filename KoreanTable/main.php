<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>콘텐츠 정보 관리</title>
    <link
      rel="stylesheet"
      href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"
    />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
  </head>
  <body>
    <!-- 시작 메뉴 화면 -->
    <div data-role="page" id="page0">
      <div data-role="header" data-position="fixed" data-theme="b">
        <h1>한국어 콘텐츠 관리</h1>
        <a
          href="#page0"
          data-icon="home"
          data-iconpos="notext"
          class="ui-btn-right"
          >Home</a
        >
      </div>
      <div data-role="content">
        <img
          style="margin: 20px auto; display: block"
          src="../img/cinema.png"
        />
        <ul data-role="listview" data-inset="true">
          <li><a href="insert.php">콘텐츠 정보 추가</a></li>
          <li><a href="update_select.php">콘텐츠 정보 갱신</a></li>
          <li><a href="delete_select.php">콘텐츠 정보 삭제</a></li>
          <li><a href="selectAll.php">전체 콘텐츠 조회</a></li>
        </ul>
      </div>
      <div data-role="footer" data-position="fixed" data-theme="b">
        <h4>Korean Education Center</h4>
      </div>
    </div>
  </body>
</html>
