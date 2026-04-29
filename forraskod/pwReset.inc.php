<?php
    include_once('ellenorzes.inc.php');
?>
  <form method="post">
    <p style="margin-top: 25px">Hitelesítés aktuális jelszóval:</p>
    <div class="input-group mb-3">
      <input
        type="password"
        class="form-control"
        placeholder="Aktuális jelszó"
        id="oldPW"
        name="oldPW"
      />
      <div class="input-group-append">
        <span
          class="input-group-text"
          style="cursor: pointer"
          onclick="oldPW.type='text';"
          onmouseout="oldPW.type='password';"
          ><img src="eye.png" style="height: 20px" alt="Jelszó megjelenítése"
        /></span>
      </div>
    </div>
    <hr />
    <p>Új jelszó (1x):</p>
    <div class="input-group mb-3">
      <input
        type="password"
        class="form-control"
        placeholder="Új jelszó"
        id="new1PW"
        name="new1PW"
      />
      <div class="input-group-append">
        <span
          class="input-group-text"
          style="cursor: pointer"
          onclick="new1PW.type='text';"
          onmouseout="new1PW.type='password';"
          ><img src="eye.png" style="height: 20px" alt="Jelszó megjelenítése"
        /></span>
      </div>
    </div>
    <p>Új jelszó (2x):</p>
    <div class="input-group mb-3">
      <input
        type="password"
        class="form-control"
        placeholder="Új jelszó"
        id="new2PW"
        name="new2PW"
      />
      <div class="input-group-append">
        <span
          class="input-group-text"
          style="cursor: pointer"
          onclick="new2PW.type='text';"
          onmouseout="new2PW.type='password';"
          ><img src="eye.png" style="height: 20px" alt="Jelszó megjelenítése"
        /></span>
      </div>
    </div>
    <input type="submit" name="pwCsereGomb" value="Jelszó megváltoztatása"
      class="btn btn-danger" />
  </form>
