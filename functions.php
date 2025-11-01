<?php
/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'twentytwentyfour_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'twentytwentyfour' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfour' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'twentytwentyfour' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'twentytwentyfour' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;


add_action( 'init', 'twentytwentyfour_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'twentytwentyfour_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'twentytwentyfour_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfour_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'twentytwentyfour' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfour' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_pattern_categories' );

/* ============================================================
 * 🔹 CÓDIGO PERSONALIZADO - MAPA DE ASSENTOS E WOOCOMMERCE
 * ============================================================ */

function shortcode_mostrar_assentos() {
  ob_start();
  include get_template_directory() . '/template-mapa-assentos.php';
  return ob_get_clean();
}

add_shortcode('mapa_assentos', 'shortcode_mostrar_assentos');

function enqueue_ingresso_condicional() {
  global $post;

  if (has_shortcode($post->post_content, 'mapa_assentos')) {
    wp_enqueue_style(
      'rafa-style-assentos',
      get_template_directory_uri() . '/css/style.css',
      [],
      filemtime(get_template_directory() . '/css/style.css')
    );

    wp_enqueue_script(
      'rafa-script-assentos',
      get_template_directory_uri() . '/js/script.js',
      [],
      filemtime(get_template_directory() . '/js/script.js'),
      true
    );
  }
}
add_action('wp_enqueue_scripts', 'enqueue_ingresso_condicional');

// Define o preço personalizado baseado na seleção do assento
add_filter('woocommerce_before_calculate_totals', function($cart) {
    foreach ($cart->get_cart() as $cart_item) {
        if (isset($cart_item['preco_personalizado'])) {
            $cart_item['data']->set_price($cart_item['preco_personalizado']);
        }
    }
});

// Exibe os assentos selecionados no resumo do pedido e do carrinho
add_filter('woocommerce_get_item_data', function($item_data, $cart_item) {
    if (isset($cart_item['assentos_selecionados'])) {
        $item_data[] = [
            'name'  => 'Assentos',
            'value' => esc_html($cart_item['assentos_selecionados']),
        ];
    }
    return $item_data;
}, 10, 2);

add_action('rest_api_init', function() {
  register_rest_route('custom/v1', '/adicionar-ingresso', array(
    'methods' => 'POST',
    'callback' => 'custom_adicionar_ingresso',
    'permission_callback' => '__return_true'
  ));
});

/*
 Usamos um produto por musical e sobrescrevemos o preço por item no carrinho.
 */
function custom_get_or_create_ticket_product($musical_id, $musical_name) {
  if (!class_exists('WC_Product_Simple')) return 0;

  global $wpdb;
  $meta_key = 'ticket_for_musical';
  $existing = $wpdb->get_var($wpdb->prepare(
    "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key=%s AND meta_value=%d LIMIT 1",
    $meta_key, $musical_id
  ));

  if ($existing) return intval($existing);

  // cria produto simples minimalista 
  $product = new WC_Product_Simple();
  $product->set_name("Ingresso - " . $musical_name);
  $product->set_status('publish');
  $product->set_catalog_visibility('hidden');
  $product->set_virtual(true);
  $product->set_regular_price('0');
  $product_id = $product->save();

  if ($product_id) {
    update_post_meta($product_id, $meta_key, $musical_id);
  }
  return $product_id;
}

/*
  Rota REST: reserva os assentos e adiciona ao carrinho.
 */
function custom_adicionar_ingresso(WP_REST_Request $request) {
    global $wpdb, $woocommerce;

    $params     = $request->get_json_params();
    $assentos_s = isset($params['assentos']) ? trim($params['assentos']) : '';
    $musical_id = isset($params['musical_id']) ? intval($params['musical_id']) : 0;

    if ($assentos_s === '' || $musical_id <= 0) {
        return rest_ensure_response(['success' => false, 'message' => 'Parâmetros inválidos.']);
    }

    // array de assentos no formato "A1,B2,C10"
    $assentos_arr = array_filter(array_map('trim', explode(',', $assentos_s)));
    if (empty($assentos_arr)) {
        return rest_ensure_response(['success' => false, 'message' => 'Nenhum assento selecionado.']);
    }

    // valida musical
   $musical = $wpdb->get_row($wpdb->prepare("SELECT * FROM musical WHERE id = %d", $musical_id), ARRAY_A);

    if (!$musical) {
        return rest_ensure_response(['success' => false, 'message' => 'Musical não encontrado.']);
    }

    // garante produto por musical
    $product_id = custom_get_or_create_ticket_product($musical_id, $musical['nome']);
    $product    = wc_get_product($product_id);
    if (!$product) {
        return rest_ensure_response(['success' => false, 'message' => 'Produto não encontrado.']);
    }

    // token de reserva 
    $reservation_token = uniqid('res_', true);
    setcookie('reservation_token', $reservation_token, time() + 300, '/'); // 5 min

    $assentos_table = 'assento';
    $reserved = [];

    foreach ($assentos_arr as $seat) {
        if (!preg_match('/^([A-Za-z]+)(\d+)$/', $seat, $m)) {
            // rollback
            foreach ($reserved as $r) {
                $wpdb->query($wpdb->prepare(
                    "UPDATE {$assentos_table}
                     SET status='livre', reserved_at=NULL, reservation_token=NULL
                     WHERE musical_id=%d AND fileira=%s AND numero=%d",
                    $musical_id, $r['fileira'], $r['numero']
                ));
            }
            return rest_ensure_response(['success' => false, 'message' => "Formato inválido do assento: {$seat}"]);
        }

        $fileira = strtoupper($m[1]);
        $numero  = intval($m[2]);

        // reserva atômica usando horário do WordPress
        $now = current_time('mysql');
        $wpdb->query($wpdb->prepare(
            "UPDATE {$assentos_table}
             SET status=%s, reserved_at=%s, reservation_token=%s
             WHERE musical_id=%d AND fileira=%s AND numero=%d
               AND (status='livre' OR (status='reservado' AND reserved_at <= %s))",
            'reservado', $now, $reservation_token,
            $musical_id, $fileira, $numero,
            $now
        ));

        if ($wpdb->rows_affected === 0) {
            // rollback
            foreach ($reserved as $r) {
                $wpdb->query($wpdb->prepare(
                    "UPDATE {$assentos_table}
                     SET status='livre', reserved_at=NULL, reservation_token=NULL
                     WHERE musical_id=%d AND fileira=%s AND numero=%d",
                    $musical_id, $r['fileira'], $r['numero']
                ));
            }
            return rest_ensure_response([
                'success' => false,
                'message' => "Assento {$seat} já não está disponível."
            ]);
        }

        
        if ((int)$musical_id === 2) {
            $price = 6.00;
        } else {
            $first_letter = strtoupper(substr($fileira, 0, 1));
            $price = in_array($first_letter, ['A','B','C']) ? 6.00 : 3.00;
        }

        // adiciona cada assento como 1 item no carrinho com chaves compatíveis
        $woocommerce->cart->add_to_cart(
            $product_id,
            1,
            0,
            [],
            [
                'id_assento'        => $fileira . $numero,
                'musical_id'        => $musical_id,
                'seat_price'        => $price,
                'reservation_token' => $reservation_token,
            ]
        );

        $reserved[] = ['fileira' => $fileira, 'numero' => $numero];
    }

    return rest_ensure_response([
        'success' => true,
        'message' => 'Assentos reservados e adicionados ao carrinho.'
    ]);
}




add_action('woocommerce_checkout_create_order', function($order, $data) {
    foreach ($order->get_items() as $item) {
        if (!empty($item->get_meta('id_assento'))) {
            $assentos[] = $item->get_meta('id_assento');
        }
    }

    if (!empty($assentos)) {
        update_post_meta($order->get_id(), 'assentos_selecionados', implode(', ', $assentos));
    }
}, 10, 2);




/**
 * Hook: aplica seat_price no item do carrinho (override de preço).
 */
 
// Salva os metadados do assento no pedido
add_action('woocommerce_checkout_create_order_line_item', function($item, $cart_item_key, $values, $order) {
    if (!empty($values['id_assento'])) {
        $item->add_meta_data('assentos', $values['id_assento'], true); // mantém "assentos" plural
    }
    if (!empty($values['musical_id'])) {
        $item->add_meta_data('musical_id', $values['musical_id'], true);
    }
}, 10, 4);


add_action('woocommerce_before_calculate_totals', function($cart) {
    if (is_admin() && !defined('DOING_AJAX')) return;

    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        if (!empty($cart_item['seat_price'])) {
            $cart_item['data']->set_price( floatval($cart_item['seat_price']) );
        }
    }
}, 10, 1);

add_action('woocommerce_payment_complete', 'forcar_pedido_como_concluido');

function forcar_pedido_como_concluido($order_id) {
    if (!$order_id) return;

    $order = wc_get_order($order_id);

    // Define como concluído somente se ainda não estiver concluído
    if ($order && $order->get_status() !== 'completed') {
        $order->update_status('completed', 'Pedido automaticamente marcado como concluído após pagamento.');
    }
}


add_action('woocommerce_payment_complete', 'custom_processar_compra_ingresso');
add_action('woocommerce_order_status_completed', 'custom_processar_compra_ingresso');
add_action('woocommerce_order_status_completed', 'enviar_email_confirmacao_customizada');
add_action('woocommerce_order_status_cancelled', 'liberar_assentos');
add_action('woocommerce_order_status_failed', 'liberar_assentos');
add_action('woocommerce_order_status_pending', 'liberar_assentos_apos_prazo');

function liberar_assentos($order_id) {
    if (!$order_id) return;

    global $wpdb;

    
    $tabela_assentos = $wpdb->prefix . 'assento';

    
    $wpdb->query(
        $wpdb->prepare(
            "UPDATE $tabela_assentos SET status = 'livre' WHERE pedido_id = %d",
            $order_id
        )
    );
}
function liberar_assentos_apos_prazo($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;

    $data_criacao = strtotime($order->get_date_created());
    if (time() - $data_criacao > 15 * 60) {
        liberar_assentos($order_id);
    }
}

add_action('woocommerce_order_status_completed', function( $order_id ) {
    $mailer = WC()->mailer();
    $mails = $mailer->get_emails();

    if ( ! empty( $mails['WC_Email_Customer_Completed_Order'] ) ) {
        $mails['WC_Email_Customer_Completed_Order']->trigger( $order_id );
    }
});
function enviar_email_confirmacao_customizada($order_id) {
    if (!$order_id) return;

    $order = wc_get_order($order_id);
    if (!$order) return;

    // Evita duplicar envio
    if (get_post_meta($order_id, '_email_confirmacao_enviado', true)) {
        return;
    }

    // Cliente
    $to_cliente = sanitize_email($order->get_billing_email());

    // Moderadores fixos
    $moderadores = [
        'matheuseduardosilva13@gmail.com',
        'rafael.santiago.silva.1405@gmail.com',
    ];
    // Terceiro moderador separado 
    $moderador_condicional = 'juliagiordanilima@gmail.com';

    // Recupera assentos e musical_id do pedido
    $assentos_arr = [];
foreach ($order->get_items() as $item) {
    $assento = $item->get_meta('assentos');
    if ($assento) $assentos_arr[] = $assento;
}
$assentos_msg = !empty($assentos_arr) ? '<p><strong>Assentos:</strong> ' . implode(', ', $assentos_arr) . '</p>' : '';


    // Pega musical_id do primeiro item do pedido
    $musical_id = null;
    foreach ($order->get_items() as $item) {
        $musical_id = $item->get_meta('musical_id');
        if ($musical_id) break;
    }

    // Telefone do cliente
    $telefone = $order->get_billing_phone();
    $telefone_msg = $telefone ? '<p><strong>Telefone:</strong> ' . esc_html($telefone) . '</p>' : '';

    $subject = 'Seu pedido foi concluído!';
    $headers = ['Content-Type: text/html; charset=UTF-8'];

    $message = '<p>Olá ' . esc_html($order->get_billing_first_name()) . ',</p>';
    $message .= '<p>Seu pedido #' . $order->get_order_number() . ' foi concluído com sucesso.</p>';
    $message .= $assentos_msg;
    $message .= $telefone_msg;
    $message .= '<p>Obrigado pela compra!</p>';

    // Envia para o cliente
    wp_mail($to_cliente, $subject, $message, $headers);

    // Envia para moderadores fixos
    foreach ($moderadores as $email_mod) {
        wp_mail(sanitize_email($email_mod), 'Novo pedido concluído', $message, $headers);
    }

    // Envia para o moderador condicional apenas se musical_id == 2
    if ($musical_id == '2') {
        wp_mail(sanitize_email($moderador_condicional), 'Novo pedido concluído', $message, $headers);
    }

    // Marca como enviado para não repetir
    update_post_meta($order_id, '_email_confirmacao_enviado', true);
}


function custom_processar_compra_ingresso($order_id) {
    global $wpdb;
    $order = wc_get_order($order_id);
    if (!$order) return;

    $nome = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
    $email = $order->get_billing_email();
    $telefone = $order->get_billing_phone();

    $wpdb->insert('clientes', [
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
    ]);
    $cliente_id = $wpdb->insert_id;

    $assentos = [];

    foreach ($order->get_items() as $item) {
        $assento_id = $item->get_meta('assentos');
        if (!$assento_id) continue;

        $assentos[] = $assento_id;

        $fileira = preg_replace('/\d+/', '', $assento_id);
        $numero = intval(preg_replace('/\D+/', '', $assento_id));

        $wpdb->update(
            'assento',
            ['status' => 'ocupado', 'reserved_at' => null, 'reservation_token' => null],
            ['fileira' => $fileira, 'numero' => $numero]
        );

        $wpdb->insert('ingresso', [
            'assento_id' => $assento_id,
            'cliente_id' => $cliente_id,
            'data_compra' => current_time('mysql')
        ]);
    }

    // Salva no meta para exibir no email
    update_post_meta($order_id, 'assentos_selecionados', implode(',', $assentos));

    enviar_email_confirmacao_customizada($order_id);
}

function enviar_email_moderadores_confirmacao($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;

    $to = 'matheuseduardosilva13@gmail.com, rafael.santiago.silva.1405@gmail.com'; // seus emails fixos separados por vírgula
    $subject = 'Novo pedido confirmado - Pedido #' . $order->get_order_number();
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    $message = '<p>Um novo pedido foi concluído.</p>';
    $message .= '<p>Cliente: ' . $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() . '</p>';
    $message .= '<p>E-mail: ' . $order->get_billing_email() . '</p>';
    $message .= '<p>Pedido #' . $order->get_order_number() . ' confirmado com sucesso.</p>';

    wp_mail($to, $subject, $message, $headers);
}


add_action('woocommerce_checkout_create_order_line_item', function($item, $cart_item_key, $values, $order) {
  if (isset($values['assentos_reservados'])) {
    $item->add_meta_data('assentos_reservados', $values['assentos_reservados'], true);
  }
}, 10, 4);


add_action( 'template_redirect', function() {
    if ( isset($_GET['musical_id']) && !empty($_GET['musical_id']) ) {
        WC()->session->set( 'musical_id', intval($_GET['musical_id']) );
    }
});


add_filter( 'woocommerce_return_to_shop_redirect', function() {
    $musical_id = WC()->session->get( 'musical_id' );

    if ( $musical_id || $_GET['musical_id'] ) {
        // monta a URL da sua página de assentos
        return home_url( '/ingressos.php?musical_id=' . $evento_id );
    }

    // se não tiver evento, vai para a home
    return home_url('/');
});


add_action( 'woocommerce_thankyou', function() {
    if ( WC()->cart ) {
        WC()->cart->empty_cart();
    }
});
// Libera assentos se o pagamento não for concluído
add_action('woocommerce_order_status_changed', 'liberar_assentos_se_pagamento_falhar', 10, 4);

function liberar_assentos_se_pagamento_falhar($order_id, $old_status, $new_status, $order) {
    global $wpdb;

    
    $status_para_liberar = ['cancelled', 'failed', 'pending', 'on-hold', 'refunded'];

   
    if (in_array($new_status, $status_para_liberar)) {

        // Busca os assentos salvos na meta do pedido
        $assentos = get_post_meta($order_id, 'assentos_selecionados', true);

        if (!empty($assentos)) {

            $lista_assentos = explode(',', $assentos);

            foreach ($lista_assentos as $assento) {
                $assento = trim($assento);
                if (preg_match('/^([A-Z])(\d+)$/i', $assento, $matches)) {
                    $fileira = strtoupper($matches[1]);
                    $numero = intval($matches[2]);

                    // Atualiza o status no banco
                    $wpdb->update(
                        'assentos',
                        ['status' => 'livre'],
                        ['fileira' => $fileira, 'numero' => $numero]
                    );
                }
            }
        }
    }
}
function atualizar_assentos_por_status($order_id, $status) {
    if (!$order_id) return;
    global $wpdb;

    
    $status_para_liberar = ['cancelled', 'failed', 'pending', 'on-hold', 'refunded'];

    if (!in_array($status, $status_para_liberar)) return;

    $assentos = get_post_meta($order_id, 'assentos_selecionados', true);
    if (empty($assentos)) return;

    $lista_assentos = array_map('trim', explode(',', $assentos));
    foreach ($lista_assentos as $assento) {
        if (preg_match('/^([A-Z]+)(\d+)$/i', $assento, $matches)) {
            $fileira = strtoupper($matches[1]);
            $numero = intval($matches[2]);

            // Atualiza o status no banco
            $wpdb->update(
                'assento',
                ['status' => 'livre', 'reserved_at' => null, 'reservation_token' => null],
                ['fileira' => $fileira, 'numero' => $numero]
            );
        }
    }
}


add_filter('woocommerce_get_item_data', function($item_data, $cart_item) {
    if (!empty($cart_item['id_assento'])) {
        $item_data[] = [
            'name'  => 'Assento(s)',
            'value' => esc_html($cart_item['id_assento']),
        ];
    }
    return $item_data;
}, 10, 2);

add_action('woocommerce_order_status_changed', function($order_id, $old_status, $new_status, $order) {
    atualizar_assentos_por_status($order_id, $new_status);
}, 10, 4);



add_action('woocommerce_after_order_notes', 'custom_offline_code_field');
function custom_offline_code_field($checkout) {
    ?>
    <div id="offline_code_field">
        <h3><?php _e('Venda Offline'); ?></h3>
        <?php
        woocommerce_form_field('offline_code', array(
            'type'        => 'text',
            'class'       => array('form-row-wide'),
            'label'       => __('Digite o código de venda offline'),
            'required'    => false,
        ), $checkout->get_value('offline_code'));
        ?>
        <button type="button" id="offline_submit" class="button">Finalizar Venda Offline</button>
    </div>
    <?php
}

// Registra endpoint AJAX
add_action('wp_ajax_process_offline_order', 'process_offline_order_callback');
add_action('wp_ajax_nopriv_process_offline_order', 'process_offline_order_callback');

function process_offline_order_callback() {
    // Verifica código
    if (!isset($_POST['offline_code'])) {
        wp_send_json_error(['message' => 'Código não enviado']);
    }

    $code = sanitize_text_field($_POST['offline_code']);
    $valid_code = 'M3D25';

    if ($code !== $valid_code) {
        wp_send_json_error(['message' => 'Código inválido']);
    }

    // Verifica carrinho
    if (WC()->cart->is_empty()) {
        wp_send_json_error(['message' => 'Carrinho vazio']);
    }

    // Cria pedido
    $order = wc_create_order();
    $assentos_comprados = [];

    // Dados do cliente
    $billing_first_name = sanitize_text_field($_POST['billing_first_name'] ?? '');
    $billing_last_name  = sanitize_text_field($_POST['billing_last_name'] ?? '');
    $billing_email      = sanitize_email($_POST['billing_email'] ?? '');
    $billing_phone      = sanitize_text_field($_POST['billing_phone'] ?? '');

    $order->set_billing_first_name($billing_first_name);
    $order->set_billing_last_name($billing_last_name);
    $order->set_billing_email($billing_email);
    $order->set_billing_phone($billing_phone);

    // Adiciona produtos e metadados
    foreach (WC()->cart->get_cart() as $cart_item) {
        $item = new WC_Order_Item_Product();
        $item->set_product_id($cart_item['product_id']);
        $item->set_quantity($cart_item['quantity']);
        
        $price = floatval($cart_item['preco'] ?? 0);
        $item->set_subtotal($price * $cart_item['quantity']);
        $item->set_total($price * $cart_item['quantity']);

        // Metadados
        if (!empty($cart_item['assento_id'])) {
            $item->add_meta_data('assento', $cart_item['assento_id'], true);
            $assentos_comprados[] = $cart_item['assento_id'];
        }
        if (!empty($cart_item['musical_id'])) {
            $item->add_meta_data('musical_id', $cart_item['musical_id'], true);
        }
        $item->add_meta_data('preco', $price, true);

        $order->add_item($item);
    }

    // Salva assentos selecionados como meta do pedido
    if (!empty($assentos_comprados)) {
        update_post_meta($order->get_id(), 'assentos_selecionados', implode(', ', $assentos_comprados));
    }

    // Calcula totais e marca como concluído
    $order->calculate_totals();
    $order->update_status('completed', __('Pedido concluído via venda offline'));

    // Esvazia o carrinho
    WC()->cart->empty_cart();

    // Retorna sucesso com redirecionamento para página inicial
    wp_send_json_success(['redirect' => home_url()]);
}

// Enqueue JS
add_action('wp_enqueue_scripts', function() {
    if (is_checkout()) {
        wp_enqueue_script('offline-code', get_template_directory_uri() . '/js/offline.js', ['jquery'], null, true);
        wp_localize_script('offline-code', 'offlineAjax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('offline_nonce')
        ]);
    }
});







add_filter( 'woocommerce_order_again_url', function( $url, $order ) {
    
    return home_url( '/' );
}, 10, 2);


