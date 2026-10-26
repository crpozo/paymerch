<?php
/**
 * Template Name: US Wallet (P2P)
 *
 * Figma: Page 2 → US Wallet / P2P.
 *
 * @package Paymerch_Figma
 */

get_header();

$pmf_benefits = array(
	array( 'receipt.svg', 17.1167, 21.45, __( 'Instant Bill Splitting', 'paymerch-figma' ), __( 'Split dinners, groceries, or group utilities with one tap. No math, no chasing friends down.', 'paymerch-figma' ), '' ),
	array( 'zap.svg', 10.3833, 12.7167, __( 'Skip Bank Delays', 'paymerch-figma' ), __( "Funds land in the recipient's Paymerch balance in seconds, not business days. Available immediately for local spending.", 'paymerch-figma' ), 'dark' ),
	array( 'private.svg', 23.6167, 21.45, __( 'Private & Direct', 'paymerch-figma' ), __( 'Your transaction history stays strictly confidential. No social feeds broadcasting what you spend or who you pay.', 'paymerch-figma' ), '' ),
);

$pmf_steps = array(
	array( 'wallet.svg', 16.5, 19, 'mint', __( 'Add Funds to Your Wallet', 'paymerch-figma' ), __( 'Connect your U.S. debit card or checking account securely via bank-grade encryption.', 'paymerch-figma' ) ),
	array( 'user.svg', 13.35, 14.85, 'lavender', __( 'Pick a Contact', 'paymerch-figma' ), __( 'Select a friend by phone number, email, or their unique Paymerch handle. No routing numbers needed.', 'paymerch-figma' ) ),
	array( 'send.svg', 18.1667, 18.1667, 'mint', __( 'Sent Instantly', 'paymerch-figma' ), __( 'Money moves in real time with immediate SMS and push confirmation to both parties.', 'paymerch-figma' ) ),
);

$pmf_trust = array(
	array( 'bank.svg', 18.15, 18.15, 'mint', __( 'BANK-GRADE CUSTODY', 'paymerch-figma' ), __( 'User funds held in FDIC-insured partner depository institutions. Your money is never at risk.', 'paymerch-figma' ), '' ),
	array( 'shield.svg', 21.45, 23.6167, 'lavender', __( 'SCAM & FRAUD SHIELD', 'paymerch-figma' ), __( 'Multi-factor authentication (2FA) and real-time transaction screening protecting against unauthorized access.', 'paymerch-figma' ), '' ),
	array( 'headset.svg', 20.8917, 20.8917, 'green', __( 'HUMAN SUPPORT ON DEMAND', 'paymerch-figma' ), __( 'Live resolution agents ready to step in when you need assistance. No automated dead-ends.', 'paymerch-figma' ), 'dark' ),
);
?>

<!-- Hero -->
<section class="pm-whero">
	<div class="pm-container pm-whero__inner">
		<div class="pm-whero__content">
			<p class="pm-badge pm-badge--outline"><span class="pm-badge__dot" aria-hidden="true"></span><?php esc_html_e( 'US WALLET · P2P TRANSFERS · ZERO FEES', 'paymerch-figma' ); ?></p>
			<h1 class="pm-whero__title"><?php esc_html_e( 'Move Money', 'paymerch-figma' ); ?><br><?php esc_html_e( 'Stateside in', 'paymerch-figma' ); ?><br><?php esc_html_e( 'Seconds.', 'paymerch-figma' ); ?><br><?php esc_html_e( 'Zero Transfer', 'paymerch-figma' ); ?><br><?php esc_html_e( 'Fees.', 'paymerch-figma' ); ?></h1>
			<p class="pm-whero__text"><?php esc_html_e( 'Split rent, settle dinner, or send cash to family across town. Keep your funds active in your digital Paymerch Wallet and transfer instantly to anyone using just a phone number or username.', 'paymerch-figma' ); ?></p>
			<div class="pm-whero__actions">
				<a class="pm-btn pm-btn--lime pm-whero__btn" href="#wallet-early-access"><?php esc_html_e( 'GET EARLY ACCESS', 'paymerch-figma' ); ?></a>
				<a class="pm-btn pm-btn--outline pm-whero__btn" href="#wallet-how"><?php esc_html_e( 'SEE HOW IT WORKS', 'paymerch-figma' ); ?></a>
			</div>
			<p class="pm-whero__pill"><?php esc_html_e( '100% FREE TRANSFERS BETWEEN PAYMERCH USERS', 'paymerch-figma' ); ?></p>
		</div>

		<div class="pm-wallet-card" aria-label="<?php esc_attr_e( 'Example wallet', 'paymerch-figma' ); ?>">
			<div class="pm-wallet-card__head">
				<span class="pm-wallet-card__label"><?php esc_html_e( 'WALLET BALANCE', 'paymerch-figma' ); ?></span>
				<span class="pm-wallet-card__balance">$1,240.00</span>
			</div>
			<ul class="pm-wallet-card__list">
				<li class="pm-wallet-card__row">
					<span class="pm-wallet-card__avatar">JD</span>
					<span class="pm-wallet-card__who"><strong>James Davis</strong><span><?php esc_html_e( 'COFFEE & LUNCH', 'paymerch-figma' ); ?></span></span>
					<span class="pm-wallet-card__amount pm-wallet-card__amount--out">−$15.40</span>
				</li>
				<li class="pm-wallet-card__row">
					<span class="pm-wallet-card__avatar pm-wallet-card__avatar--mint">MP</span>
					<span class="pm-wallet-card__who"><strong>Maria Perez</strong><span><?php esc_html_e( 'SHARED RENT', 'paymerch-figma' ); ?></span></span>
					<span class="pm-wallet-card__amount">+$350.00</span>
				</li>
			</ul>
			<p class="pm-whero__speed"><?php esc_html_e( 'ϟ INSTANT · ZERO FEES', 'paymerch-figma' ); ?></p>
		</div>
	</div>
</section>

<!-- Everyday wallet benefits -->
<section class="pm-wben">
	<div class="pm-container">
		<p class="pm-kicker"><?php esc_html_e( 'EVERYDAY BENEFITS', 'paymerch-figma' ); ?></p>
		<ul class="pm-wben__list">
			<?php foreach ( $pmf_benefits as $pmf_b ) : ?>
				<li class="pm-wben__card<?php echo $pmf_b[5] ? ' pm-wben__card--dark' : ''; ?>">
					<span class="pm-wben__icon"><img src="<?php echo esc_url( pmf_asset( 'img/icons/' . $pmf_b[0] ) ); ?>" alt="" width="<?php echo esc_attr( $pmf_b[1] ); ?>" height="<?php echo esc_attr( $pmf_b[2] ); ?>"></span>
					<h2 class="pm-wben__title"><?php echo esc_html( $pmf_b[3] ); ?></h2>
					<p class="pm-wben__text"><?php echo esc_html( $pmf_b[4] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<!-- US wallet to international rails -->
<section class="pm-bridge">
	<div class="pm-bridge__photo">
		<img src="<?php echo esc_url( pmf_asset( 'img/wallet-bridge.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Family looking at a phone together at home', 'paymerch-figma' ); ?>" width="560" height="760" loading="lazy">
	</div>
	<div class="pm-bridge__content">
		<p class="pm-bridge__eyebrow"><span aria-hidden="true"></span><?php esc_html_e( 'US WALLET · INTERNATIONAL RAILS', 'paymerch-figma' ); ?></p>
		<h2 class="pm-bridge__title"><?php esc_html_e( 'One Wallet for Your Life', 'paymerch-figma' ); ?><br><?php esc_html_e( 'Here and Your Family', 'paymerch-figma' ); ?><br><?php esc_html_e( 'Back Home.', 'paymerch-figma' ); ?></h2>
		<p class="pm-bridge__text"><?php esc_html_e( "Keep your earnings in your Paymerch digital balance. Pay your local expenses stateside, and when it's time to support family in Mexico or Colombia, remit directly from your balance in seconds—completely skipping physical cash counter queues and avoiding cash remittance taxes.", 'paymerch-figma' ); ?></p>

		<div class="pm-diagram" role="img" aria-label="<?php esc_attr_e( 'US Wallet funds move over direct rails to Mexico (SPEI) and Colombia (ACH).', 'paymerch-figma' ); ?>">
			<div class="pm-diagram__node pm-diagram__node--wallet">
				<span class="pm-diagram__label"><?php esc_html_e( 'US WALLET', 'paymerch-figma' ); ?></span>
				<img src="<?php echo esc_url( pmf_asset( 'img/icons/dollar.svg' ) ); ?>" alt="" width="18.15" height="18.15">
				<span class="pm-diagram__note"><?php esc_html_e( 'ACH / Debit', 'paymerch-figma' ); ?><br><?php esc_html_e( 'Direct Funding', 'paymerch-figma' ); ?></span>
			</div>
			<img class="pm-diagram__arrow" src="<?php echo esc_url( pmf_asset( 'img/icons/arrow-right.svg' ) ); ?>" alt="" width="22.275" height="17.775">
			<div class="pm-diagram__node pm-diagram__node--rails">
				<span class="pm-diagram__label"><?php esc_html_e( 'DIRECT RAILS', 'paymerch-figma' ); ?></span>
				<img src="<?php echo esc_url( pmf_asset( 'img/icons/zap-lime.svg' ) ); ?>" alt="" width="16.3167" height="19.9834">
				<span class="pm-diagram__note"><?php esc_html_e( 'Zero Spread', 'paymerch-figma' ); ?><br><?php esc_html_e( 'Real-time', 'paymerch-figma' ); ?></span>
			</div>
			<img class="pm-diagram__fork pm-diagram__fork--up" src="<?php echo esc_url( pmf_asset( 'img/icons/arrow-up-right.svg' ) ); ?>" alt="" width="13.1667" height="13.1667">
			<img class="pm-diagram__fork pm-diagram__fork--down" src="<?php echo esc_url( pmf_asset( 'img/icons/arrow-down-right.svg' ) ); ?>" alt="" width="13.1667" height="13.1667">
			<div class="pm-diagram__dest pm-diagram__dest--mx">
				<span class="pm-diagram__country"><?php esc_html_e( 'MEXICO', 'paymerch-figma' ); ?></span>
				<strong>SPEI / BBVA / BANORTE</strong>
				<span class="pm-diagram__eta"><?php esc_html_e( '< 5 min delivery', 'paymerch-figma' ); ?></span>
			</div>
			<div class="pm-diagram__dest pm-diagram__dest--co">
				<span class="pm-diagram__country"><?php esc_html_e( 'COLOMBIA', 'paymerch-figma' ); ?></span>
				<strong>ACH / BANCOLOMBIA</strong>
				<span class="pm-diagram__eta"><?php esc_html_e( 'Direct bank deposit', 'paymerch-figma' ); ?></span>
			</div>
		</div>

		<dl class="pm-bridge__metrics">
			<div>
				<dt><?php esc_html_e( 'METRIC ANCHOR', 'paymerch-figma' ); ?></dt>
				<dd><?php esc_html_e( 'Zero Cash Tax', 'paymerch-figma' ); ?></dd>
			</div>
			<div>
				<dt><?php esc_html_e( 'SETTLEMENT', 'paymerch-figma' ); ?></dt>
				<dd><?php esc_html_e( 'Direct SPEI & Local Rails', 'paymerch-figma' ); ?></dd>
			</div>
		</dl>
		<a class="pm-bridge__link" href="<?php echo esc_url( pmf_page_url( 'international' ) ); ?>"><?php esc_html_e( 'SEE INTERNATIONAL REMITTANCE RATES', 'paymerch-figma' ); ?>&nbsp; →</a>
	</div>
</section>

<!-- The logic of real-time money -->
<section class="pm-logic" id="wallet-how">
	<div class="pm-container">
		<h2 class="pm-logic__title"><?php esc_html_e( 'The Logic of Real Time Money', 'paymerch-figma' ); ?></h2>
		<ol class="pm-logic__list">
			<?php foreach ( $pmf_steps as $pmf_i => $pmf_s ) : ?>
				<li class="pm-logic__step">
					<span class="pm-logic__num"><?php echo esc_html( sprintf( '%02d', $pmf_i + 1 ) ); ?></span>
					<span class="pm-logic__head">
						<span class="pm-logic__icon pm-logic__icon--<?php echo esc_attr( $pmf_s[3] ); ?>"><img src="<?php echo esc_url( pmf_asset( 'img/icons/' . $pmf_s[0] ) ); ?>" alt="" width="<?php echo esc_attr( $pmf_s[1] ); ?>" height="<?php echo esc_attr( $pmf_s[2] ); ?>"></span>
						<span class="pm-logic__step-title"><?php echo esc_html( $pmf_s[4] ); ?></span>
					</span>
					<span class="pm-logic__text"><?php echo esc_html( $pmf_s[5] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<!-- Custody, fraud protection and support -->
<section class="pm-trust">
	<div class="pm-container">
		<p class="pm-kicker"><?php esc_html_e( 'TRUST & SECURITY', 'paymerch-figma' ); ?></p>
		<ul class="pm-trust__list">
			<?php foreach ( $pmf_trust as $pmf_t ) : ?>
				<li class="pm-trust__card<?php echo $pmf_t[6] ? ' pm-trust__card--dark' : ''; ?>">
					<span class="pm-trust__icon pm-trust__icon--<?php echo esc_attr( $pmf_t[3] ); ?>"><img src="<?php echo esc_url( pmf_asset( 'img/icons/' . $pmf_t[0] ) ); ?>" alt="" width="<?php echo esc_attr( $pmf_t[1] ); ?>" height="<?php echo esc_attr( $pmf_t[2] ); ?>"></span>
					<h2 class="pm-trust__title"><?php echo esc_html( $pmf_t[4] ); ?></h2>
					<p class="pm-trust__text"><?php echo esc_html( $pmf_t[5] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<!-- Early access -->
<section class="pm-wearly" id="wallet-early-access">
	<img class="pm-wearly__bg" src="<?php echo esc_url( pmf_asset( 'img/wallet-early-overlay.jpg' ) ); ?>" alt="" width="1881" height="779" loading="lazy">
	<div class="pm-wearly__card">
		<p class="pm-eyebrow"><?php esc_html_e( 'EARLY ACCESS', 'paymerch-figma' ); ?></p>
		<h2 class="pm-wearly__title"><?php esc_html_e( 'Reserve your unique Paymerch tag before public launch.', 'paymerch-figma' ); ?></h2>
		<p class="pm-wearly__text"><?php esc_html_e( 'Join the sovereign sender waitlist today. Be the first to', 'paymerch-figma' ); ?><br><?php esc_html_e( 'experience zero-spread remittances.', 'paymerch-figma' ); ?></p>
		<form class="pm-wearly__form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="pmf_waitlist">
			<?php wp_nonce_field( 'pmf_waitlist', 'pmf_nonce' ); ?>
			<label class="screen-reader-text" for="pm-wallet-contact"><?php esc_html_e( 'Email or phone number', 'paymerch-figma' ); ?></label>
			<input class="pm-input pm-input--lavender" id="pm-wallet-contact" name="contact" type="text" required autocomplete="email" placeholder="<?php esc_attr_e( 'Email or phone number', 'paymerch-figma' ); ?>">
			<button class="pm-btn pm-btn--lime pm-wearly__join" type="submit"><?php esc_html_e( 'JOIN WAITLIST', 'paymerch-figma' ); ?></button>
		</form>
		<?php pmf_waitlist_message( 'pm-early__msg' ); ?>
		<div class="pm-wearly__extras">
			<div class="pm-qr" aria-hidden="true">
				<span class="pm-qr__row"><i class="pm-qr__f"></i><i class="pm-qr__f"></i></span>
				<span class="pm-qr__row pm-qr__row--mid"><i class="pm-qr__m"></i></span>
				<span class="pm-qr__row"><i class="pm-qr__f"></i><i class="pm-qr__f pm-qr__f--lavender"></i></span>
				<span class="pm-qr__label">SCAN TO JOIN<br>WAITLIST</span>
			</div>
			<div class="pm-wearly__links">
				<a class="pm-btn pm-btn--lime pm-wearly__how" href="#wallet-how"><?php esc_html_e( 'See how it works', 'paymerch-figma' ); ?></a>
				<a class="pm-btn pm-wearly__play" href="<?php echo esc_url( get_theme_mod( 'pmf_play_url', '#' ) ); ?>"><?php esc_html_e( 'GOOGLE PLAY', 'paymerch-figma' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
