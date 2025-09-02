<?php get_header(); ?>

<div class="p-lower-mv">
  <div class="l-section-inner">
    <?php breadcrumb(); ?>
  </div>
</div>

<div class="c-header">
  <div class="l-section-inner">
    <hgroup>
      <h1 class="c-title-ja">募集要項</h1>
      <p class="c-title-en">recruit information</p>
    </hgroup>
    <figure>
      <img src="<?php img_path(); ?>/recruit/recruitment/img_header.jpg" alt="" loading="lazy" width="1588" height="600">
    </figure>
  </div>
</div>

<section class="c-sticky l-section">
  <div class="p-recruitment-tab-panel js-tab-panel">
    <ul class="p-recruitment-tab">
      <li class="tab tab-1 is-active">新卒採用</li>
      <li class="tab tab-2">中途採用</li>
    </ul>
    <div class="p-recruitment-panel">
      <div class="panel tab-1 is-show">
        <div class="l-section-inner">
          <div class="c-sticky-link">
            <ul>
              <li><a href="#recruitment">2026年度学卒者募集要領</a></li>
              <li><a href="#exam">一次入社試験</a></li>
              <li><a href="#contact">連絡先</a></li>
            </ul>
          </div>
          <div class="c-sticky-contents">
            <div id="recruitment" class="c-section-row">
              <h2 class="c-section-row-title">2026年度学卒者募集要領</h2>
              <dl class="p-recruitment-list">
                <?php 
                $requirements = get_recruitment_field(get_the_ID(), 'shinsotsu_requirements');
                ?>
                <?php if (!empty($requirements['saiyou_shokushu'])): ?>
                <div>
                  <dt>採用職種</dt>
                  <dd><?php echo recruitment_nl2br($requirements['saiyou_shokushu']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['saiyou_ninzu'])): ?>
                <div>
                  <dt>採用人数</dt>
                  <dd><?php echo recruitment_nl2br($requirements['saiyou_ninzu']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['kinmu_chi'])): ?>
                <div>
                  <dt>勤務地</dt>
                  <dd><?php echo recruitment_nl2br($requirements['kinmu_chi']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['kinmu_jikan'])): ?>
                <div>
                  <dt>勤務時間</dt>
                  <dd><?php echo recruitment_nl2br($requirements['kinmu_jikan']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['kyujitsu'])): ?>
                <div>
                  <dt>休日</dt>
                  <dd><?php echo recruitment_nl2br($requirements['kyujitsu']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['shoninkyuu'])): ?>
                <div>
                  <dt>初任給</dt>
                  <dd><?php echo recruitment_nl2br($requirements['shoninkyuu']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['shoteate'])): ?>
                <div>
                  <dt>諸手当</dt>
                  <dd><?php echo recruitment_nl2br($requirements['shoteate']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['shakai_hoken'])): ?>
                <div>
                  <dt>社会保険</dt>
                  <dd><?php echo recruitment_nl2br($requirements['shakai_hoken']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['fukuri_kousei'])): ?>
                <div>
                  <dt>福利厚生</dt>
                  <dd><?php echo recruitment_nl2br($requirements['fukuri_kousei']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['saiyou_jisseki_daigaku'])): ?>
                <div>
                  <dt>採用実績大学</dt>
                  <dd><?php echo recruitment_nl2br($requirements['saiyou_jisseki_daigaku']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['saiyou_jisseki_koukou'])): ?>
                <div>
                  <dt>採用実績高校</dt>
                  <dd><?php echo recruitment_nl2br($requirements['saiyou_jisseki_koukou']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($requirements['saiyou_jisseki_jinin'])): ?>
                <div>
                  <dt>採用実績人員</dt>
                  <dd><?php echo $requirements['saiyou_jisseki_jinin']; ?></dd>
                </div>
                <?php endif; ?>
              </dl>
            </div>
            <div id="exam" class="c-section-row">
              <h2 class="c-section-row-title">一次入社試験</h2>
              <?php $exam = get_recruitment_field(get_the_ID(), 'shinsotsu_exam'); ?>
              <?php if (!empty($exam['exam_description'])): ?>
                <p><?php echo recruitment_nl2br($exam['exam_description']); ?></p>
              <?php endif; ?>
            </div>
            <div id="contact" class="c-section-row">
              <h2 class="c-section-row-title">連絡先</h2>
              <table class="c-table sp-block">
                <tbody>
                  <?php $contact = get_recruitment_field(get_the_ID(), 'shinsotsu_contact'); ?>
                  <?php if (!empty($contact['postal_code'])): ?>
                  <tr>
                    <th>郵便番号</th>
                    <td><?php echo recruitment_nl2br($contact['postal_code']); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php if (!empty($contact['address'])): ?>
                  <tr>
                    <th>住所</th>
                    <td><?php echo recruitment_nl2br($contact['address']); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php if (!empty($contact['contact_person'])): ?>
                  <tr>
                    <th>担当者</th>
                    <td><?php echo recruitment_nl2br($contact['contact_person']); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php if (!empty($contact['phone'])): ?>
                  <tr>
                    <th>電話番号</th>
                    <td><?php echo recruitment_nl2br($contact['phone']); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php if (!empty($contact['fax'])): ?>
                  <tr>
                    <th>FAX番号</th>
                    <td><?php echo recruitment_nl2br($contact['fax']); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php if (!empty($contact['email'])): ?>
                  <tr>
                    <th>Eメール</th>
                    <td><?php echo recruitment_nl2br($contact['email']); ?></td>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="panel tab-2">
        <div class="l-section-inner">
          <div class="c-sticky-link">
            <ul>
              <li><a href="#sales">営業</a></li>
              <li><a href="#engineer">サービスエンジニア</a></li>
              <li><a href="#assembly">組立作業職</a></li>
              <li><a href="#labor">労働条件</a></li>
              <li><a href="#contact2">連絡先</a></li>
            </ul>
          </div>
          <div class="c-sticky-contents">
            <div id="sales" class="c-section-row">
              <h2 class="c-section-row-title">営業</h2>
              <dl class="p-recruitment-list">
                <?php $sales = get_recruitment_field(get_the_ID(), 'chuuto_sales'); ?>
                <?php if (!empty($sales['job_content'])): ?>
                <div>
                  <dt>職務内容</dt>
                  <dd><?php echo recruitment_nl2br($sales['job_content']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($sales['qualifications'])): ?>
                <div>
                  <dt>応募資格</dt>
                  <dd><?php echo recruitment_nl2br($sales['qualifications']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($sales['location'])): ?>
                <div>
                  <dt>勤務地</dt>
                  <dd><?php echo recruitment_nl2br($sales['location']); ?></dd>
                </div>
                <?php endif; ?>
              </dl>
            </div>
            <div id="engineer" class="c-section-row">
              <h2 class="c-section-row-title">サービスエンジニア</h2>
              <dl class="p-recruitment-list">
                <?php $engineer = get_recruitment_field(get_the_ID(), 'chuuto_engineer'); ?>
                <?php if (!empty($engineer['job_content'])): ?>
                <div>
                  <dt>職務内容</dt>
                  <dd><?php echo recruitment_nl2br($engineer['job_content']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($engineer['qualifications'])): ?>
                <div>
                  <dt>応募資格</dt>
                  <dd><?php echo recruitment_nl2br($engineer['qualifications']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($engineer['location'])): ?>
                <div>
                  <dt>勤務地</dt>
                  <dd><?php echo recruitment_nl2br($engineer['location']); ?></dd>
                </div>
                <?php endif; ?>
              </dl>
            </div>
            <div id="assembly" class="c-section-row">
              <h2 class="c-section-row-title">組立作業職</h2>
              <dl class="p-recruitment-list">
                <?php $assembly = get_recruitment_field(get_the_ID(), 'chuuto_assembly'); ?>
                <?php if (!empty($assembly['job_content'])): ?>
                <div>
                  <dt>職務内容</dt>
                  <dd><?php echo recruitment_nl2br($assembly['job_content']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($assembly['qualifications'])): ?>
                <div>
                  <dt>応募資格</dt>
                  <dd><?php echo recruitment_nl2br($assembly['qualifications']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($assembly['location'])): ?>
                <div>
                  <dt>勤務地</dt>
                  <dd><?php echo recruitment_nl2br($assembly['location']); ?></dd>
                </div>
                <?php endif; ?>
              </dl>
            </div>
            <div id="labor" class="c-section-row">
              <h2 class="c-section-row-title">労働条件</h2>
              <dl class="p-recruitment-list">
                <?php $labor = get_recruitment_field(get_the_ID(), 'chuuto_labor'); ?>
                <?php if (!empty($labor['salary_image'])): ?>
                <div>
                  <dt>給与イメージ</dt>
                  <dd><?php echo recruitment_nl2br($labor['salary_image']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($labor['raise'])): ?>
                <div>
                  <dt>昇給</dt>
                  <dd><?php echo recruitment_nl2br($labor['raise']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($labor['bonus'])): ?>
                <div>
                  <dt>賞与</dt>
                  <dd><?php echo recruitment_nl2br($labor['bonus']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($labor['work_time'])): ?>
                <div>
                  <dt>勤務時間</dt>
                  <dd><?php echo recruitment_nl2br($labor['work_time']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($labor['holiday'])): ?>
                <div>
                  <dt>休日</dt>
                  <dd><?php echo recruitment_nl2br($labor['holiday']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($labor['allowance'])): ?>
                <div>
                  <dt>諸手当</dt>
                  <dd><?php echo recruitment_nl2br($labor['allowance']); ?></dd>
                </div>
                <?php endif; ?>
                <?php if (!empty($labor['insurance'])): ?>
                <div>
                  <dt>社会保険</dt>
                  <dd><?php echo recruitment_nl2br($labor['insurance']); ?></dd>
                </div>
                <?php endif; ?>
              </dl>
            </div>
            <div id="contact2" class="c-section-row">
              <h2 class="c-section-row-title">連絡先</h2>
              <table class="c-table sp-block">
                <tbody>
                  <?php $contact2 = get_recruitment_field(get_the_ID(), 'chuuto_contact'); ?>
                  <?php if (!empty($contact2['postal_code'])): ?>
                  <tr>
                    <th>郵便番号</th>
                    <td><?php echo recruitment_nl2br($contact2['postal_code']); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php if (!empty($contact2['address'])): ?>
                  <tr>
                    <th>住所</th>
                    <td><?php echo recruitment_nl2br($contact2['address']); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php if (!empty($contact2['contact_person'])): ?>
                  <tr>
                    <th>担当者</th>
                    <td><?php echo recruitment_nl2br($contact2['contact_person']); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php if (!empty($contact2['phone'])): ?>
                  <tr>
                    <th>電話番号</th>
                    <td><?php echo recruitment_nl2br($contact2['phone']); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php if (!empty($contact2['fax'])): ?>
                  <tr>
                    <th>FAX番号</th>
                    <td><?php echo recruitment_nl2br($contact2['fax']); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php if (!empty($contact2['email'])): ?>
                  <tr>
                    <th>Eメール</th>
                    <td><?php echo recruitment_nl2br($contact2['email']); ?></td>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>