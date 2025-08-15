<?php get_header(); ?>

<div class="p-lower-mv">
  <div class="l-section-inner">
    <?php breadcrumb(); ?>
    <hgroup class="p-lower-mv-title">
      <h1>製品一覧</h1>
      <p>products</p>
    </hgroup>
  </div>
</div>

<div class="p-product-wrapper l-section">
  <div class="l-section-inner">
    <div class="p-product-wrapper-col">
      <div class="p-product-search">
        <div class="p-product-search-input">
          <form action="" class="p-product-search-input-form">
            <input type="search" placeholder="フリーワードで探す" class="p-product-search-input-input">
            <button type="submit" class="p-product-search-input-submit"><i class="c-icon search"></i></button>
          </form>
        </div>
        <div class="p-product-search-input p-product-search-detail">
          <form action="">
            <div class="p-product-search-detail-head">
              <p class="p-product-search-detail-title">条件で探す</p>
              <input type="reset" value="リセット" class="p-product-search-detail-reset">
            </div>
            <button class="p-product-search-detail-spbtn"><i class="c-icon arrow-down cl-green"></i></button>
            <div class="p-product-search-detail-contents-wrapper">
              <div class="p-product-search-detail-contents">
                <p class="p-product-search-detail-contents-title">製品から探す</p>
                <div class="p-product-search-detail-contents-list">
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="農業機械" class="checkbox">
                    農業機械
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="洗浄機" class="checkbox">
                    洗浄機
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="アタッチメント（洗浄機のノズル等）" class="checkbox">
                    アタッチメント（洗浄機のノズル等）
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="ポンプ" class="checkbox">
                    ポンプ
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="ミスト" class="checkbox">
                    ミスト
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="その他（オートマット、トルミング等）" class="checkbox">
                    その他（オートマット、トルミング等）
                  </label>
                </div>
              </div>
              <div class="p-product-search-detail-contents">
                <p class="p-product-search-detail-contents-title">目的・用途から探す</p>
                <div class="p-product-search-detail-contents-list">
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="薬剤/肥料をまく" class="checkbox">
                    薬剤/肥料をまく
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="高圧で洗浄する（モーター）" class="checkbox">
                    高圧で洗浄する（モーター）
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="高圧で洗浄する（エンジン）" class="checkbox">
                    高圧で洗浄する（エンジン）
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="高圧で洗浄する（温水）" class="checkbox">
                    高圧で洗浄する（温水）
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="容器/器具/パレット/部品を洗う" class="checkbox">
                    容器/器具/パレット/部品を洗う
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="その他のものを洗う" class="checkbox">
                    その他のものを洗う
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="泡で洗う" class="checkbox">
                    泡で洗う
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="水圧を供給する" class="checkbox">
                    水圧を供給する
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="薬剤の泡で洗う" class="checkbox">
                    薬剤の泡で洗う
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="冷却/防塵/消臭する" class="checkbox">
                    冷却/防塵/消臭する
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="checkbox" value="その他" class="checkbox">
                    その他
                  </label>
                </div>
              </div>
              <div class="p-product-search-detail-contents">
                <div class="p-product-search-detail-contents-submit">
                  <input type="submit" name="submit" value="検索する（00件）">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="p-product-list">
        <div class="p-product-list-head">
          <p class="p-product-list-head-text">64件中、1〜12件を表示</p>
          <a href="../product" class="p-product-list-head-reset">絞り込みをリセット</a>
        </div>
        <ul class="p-product-list-list">
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_01.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">ハウススプレー</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_02.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">ブームスプレーヤ</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_03.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">静電ノズル</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_01.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">ハウススプレー</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_02.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">ブームスプレーヤ</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_03.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">静電ノズル</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_01.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">ハウススプレー</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_02.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">ブームスプレーヤ</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_03.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">静電ノズル</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_01.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">ハウススプレー</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_02.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">ブームスプレーヤ</h2>
            </a>
          </li>
          <li class="p-product-list-item">
            <a href="detail">
              <figure class="p-product-list-item-img">
                <img src="<?php img_path(); ?>/dummy/img_product_03.jpg" alt="" loading="lazy" width="424" height="282">
              </figure>
              <p class="p-product-list-item-text">ここにはシリーズの説明テキストが入ります</p>
              <h2 class="p-product-list-item-title">静電ノズル</h2>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="p-pagination">
      <a class="prev page-numbers non-active" href="DUMMY"></a>
      <span class="page-numbers current">1</span>
      <a class="page-numbers" href="DUMMY">2</a>
      <a class="page-numbers" href="DUMMY">3</a>
      <a class="page-numbers" href="DUMMY">4</a>
      <a class="next page-numbers" href="DUMMY"></a>
    </div>
    <?php get_template_part('inc/cta'); ?>
  </div>
</div>

<?php get_footer(); ?>