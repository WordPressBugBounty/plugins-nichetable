<?php
/**
 * Plugins Admin menu
 * @package NicheTable
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



if ( !function_exists( 'nichetablewpwp_settings_page_render' ) ) {
  function nichetablewpwp_settings_page_render()
  {
      ?>
<div class="nichetable_hero">
  <div class="t_container">
    <div class="t_row">
      <div class="col-md-6">
        <h2>Help & Instruction</h2>
      </div>
      <div class="col-md-6 text-right">
        <img src="https://wpdab.com/img/nichetable/nichetable-logo2.png" alt="logo">
      </div>
    </div>
  </div>
</div>
<div class="nichetable_section s_1">
  <div class="t_container">
    <div class="t_row">
      <div class="col-md-8">
        <h2>Get Started 👍</h2>
        <div class="inustruction">
          <h3 class="head">Create a Table by Niche Table Block</h3>
          <div class="t_row">
            <div class="col-md-7">
              <h4>You now have NicheTable blocks in your block editor</h4>
              <p>&#10140; Create a new page or post and click on the <img
                  src="https://wpdab.com/img/nichetable/editor-plus-icon.svg" alt="img"> button to add a block</p>
              <p>&#10140; Scroll down and pick a NicheTable block and customize it!</p>
            </div>
            <div class="col-md-5">
              <img class="importimg" src="https://wpdab.com/img/nichetable/nichetable-block.gif" alt="logo">
            </div>
          </div>
        </div>
        <div class="inustruction">
          <h3 class="head">Import a Table</h3>
          <h4>&#10140; Go to your post or page editor</h4>
          <h4>&#10140; Click Import Table.</h4>
          <span>Here is displaying some table demo</span>
          <h4>&#10140; Click on import button.</h4>
          <span>keep only a single Table row add change the information that we want.
            note: For the delete, other rows Select row first by <strong>click setting icon that appears right side of
              the row on mouse hover</strong>. In the right site showing row setting.<br>
            Now press delete key from your keyboard or click more icon then click Remove Block.</span>
          <h4>&#10140; Select row then Duplicate row ctrl + shift + D or click more icon then Duplicate add change the
            information same process</h4>
            <div class="pt-20">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/p1WW-auijOA" frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>
              </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="pro_fiture">
          <h3 class="text-center"> 🚀 NicheTable Premium</h3>
          <p class="text-center">If you are ready for even</br> more, upgrade to Premium and get:</p>
          <ul>
            <li>Three Super responsive <strong>mobile version style</strong></li>
            <li>Different type style of <strong>level </strong>as like as the Top pick</li>
            <li>Highlighting of the individual Row</li>
            <li>Highlighting of the individual Table data</li>
            <li><strong>Rating,</strong> Star Rating</li>
            <li>Set any Link(anchor) <strong>rel</strong> value(<strong>nofollow,</strong> sponsored, ugc)</li>
            <li>Will be able to use <strong>list</strong> and change <strong>list before icon</strong>.</li>
            <li>One click demo import</li>
            <li><strong>Continue to enjoy the premium table that you created for front-end even after your license
                expires</strong>.</li>
            <li>1 Year of Premium Support</li>
          </ul>
          <div class="demo"><a href="./admin.php?page=nichetablewpwp-pricing">Get NicheTable Premium</a></div>
          <div>
          <p style="color: #ff4c4c; text-align: center; border: 1px dashed red; padding: 5px 5px 8px; line-height: 1.2;">Do you know According to google analytics more than 55% of visitor came from mobile?</p>
          </div>
          <h3 class="text-center">NicheTable Premium Mobile <br />Version Style Look-like <h3>
        <img class="mobailimg" src="https://wpdab.com/img/nichetable/mobail-responsive-img.png" alt="logo">
        </div>
        
      </div>
    </div>
  </div>
</div>
<div class="nichetable_section bg1 section_space1 text-center">
  <div class="t_container">
    <h2 class="pb-20">Helpful Videos</h2>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/vL9BtK2wxoY" frameborder="0"
      allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
</div>

  <?php 
  }

}


