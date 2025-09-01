<?php get_header(); ?>

<div class="p-lower-mv">
  <div class="l-section-inner">
  <?php breadcrumb(); ?>
  </div>
</div>

<div class="c-header">
  <div class="l-section-inner">
    <hgroup>
      <h1 class="c-title-ja">アンローダバルブのしくみ</h1>
      <p class="c-title-en">structure <span style="text-transform: lowercase;">of</span> unloader valve</p>
    </hgroup>
    <figure>
      <img src="<?php img_path(); ?>/technology/img_04.jpg" alt="" loading="lazy" width="696" height="348">
    </figure>
  </div>
</div>

<section class="p-technology-classroom l-section">
  <div class="l-section-inner small">
    <div class="p-technology-classroom-row">
      <h2>アンローダバルブの機能</h2>
      <p>アンローダバルブを下図の様に取付けて、一定の圧力に設定することにより、洗浄ノズル開放の場合<span class="u-color-blue">❶</span>方向となります。洗浄ノズルが閉じられた場合、圧力が上昇し、設定圧力以上になると、アンローダバルブが働き、流れは<span class="u-color-blue">❷</span>の方向に変わり、余水ホースからタンクへ還流され、ポンプは低圧運転されます。</p>
      <div class="image-col">
        <img src="<?php img_path(); ?>/technology/unload01.gif" alt="" loading="lazy" width="230" height="218">
        <img src="<?php img_path(); ?>/technology/unload02.gif" alt="" loading="lazy" width="230" height="218">
      </div>
    </div>
    <div class="p-technology-classroom-row">
      <h2>アンローダバルブの動作原理</h2>
      <figure class="fig02"><img src="<?php img_path(); ?>/technology/unload03.jpg" alt="" loading="lazy" width="245" height="246"></figure>
      <p><span class="u-color-blue">❶</span>の調圧ネジを締めることにより、噴出圧力を設定します。吐水入口より圧力が加わり、設定圧力以上になると直動形リリーフ弁を押し上げて余水することになります。ノズルを閉じた場合、<span class="u-color-blue">❸</span>のチャッキ弁が閉じ、高圧水が<span class="u-color-blue">❷</span>の通路を通って<span class="u-color-blue">❹</span>のピストンを押し上げたまま保持することが可能となり、この時、全余水運転を行います。またノズルを開いた場合、アンローダ内の圧力が下がり、<span class="u-color-blue">❹</span>のピストンが降りて、通常運転となります。</p>
    </div>
    <div class="p-technology-classroom-row">
      <h2>アンローダバルブの特長</h2>
      <ol>
        <li>調圧弁の機能をそなえている<br>ノズルからの水の噴射時、従来型のアンローダと異なり、圧力調整ができます。従来はノズル径と吐出量で一定の圧力しか使用出来ませんでしたが、自由な圧力に調整ができます。</li>
        <li>小型軽量である<br>従来の調圧弁に比べて、コンパクトにまとめられているので、小型軽量です。</li>
        <li>構造簡単<br>構造が簡単なため取扱いが簡単で故障が少なく、分解・予備品交換も容易です。</li>
        <li>耐久性
          <ul>
            <li>ディスクは摩耗に強いセラミックボールを使用しております、尚且つ球形回転構造により摩耗抵抗を少なくし、より耐久性を向上させる方式にしております。</li>
            <li>シートについては材質はSUS製で、両面交換可能な経済的なタイプにしております。</li>
          </ul>
        </li>
      </ol>
    </div>
</section>

<?php get_template_part('parts/technology'); ?>

<?php get_template_part('parts/cta'); ?>

<?php get_footer(); ?>
