<?php
/*
Template Name: Mapa de Assentos
*/
get_header();
?>

<div class="conteudo-mapa-assentos">
    <?php

require_once dirname(__FILE__) . '/wp-load.php'; // carrega o WordPress inteiro

global $wpdb;

$musical_id = isset($_GET['musical_id']) ? intval($_GET['musical_id']) : 0;

$musical = $wpdb->get_row("SELECT * FROM musical WHERE id = $musical_id", ARRAY_A);

if (!$musical) {
  wp_redirect(site_url()); // redireciona para a home do WP
  exit;
}

$assentos = $wpdb->get_results("SELECT * FROM assento WHERE musical_id = $musical_id", ARRAY_N);
$assentos_size = count($assentos);
$fileiras = strtoupper("abcdefghijklmnopqrst");

$esquerda = [];
$direita = [];

foreach ($assentos as $key => $assento) {
  if ($assento[1] < 10)
    $esquerda[] = $assento;
  else
    $direita[] = $assento;
}
?>

<!DOCTYPE html>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $musical["nome"] ?> - Mapa de Assentos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background: #f0f0f0;
    }

    .ocupado {
      background: red;
    }

    .container-palco-e-auditorio {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
    }

    .palco {
      width: 60%;
      text-align: center;
      background-color: #444;
      color: white;
      font-weight: bold;
      padding: 12px 0;
      margin-bottom: 50px;
      font-size: 18px;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .auditorio {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 100px;
    }

    .grupo-esquerda,
    .grupo-direita {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .fileira {
      display: flex;
      gap: 5px;
      align-items: center;
    }

    .num-fileira {
      width: 20px;
      text-align: center;
      line-height: 25px;
      font-weight: bold;
      color: #333;
      user-select: none;
    }

    .assento {
      width: 25px;
      height: 25px;
      background-color: #ccc;
      border-radius: 4px;
      text-align: center;
      line-height: 25px;
      font-size: 12px;
      cursor: pointer;
    }

    .assento.vip {
      background-color: #007bff;
    }

    .assento.selecionado {
      background-color: #28a745;
      color: white;
    }

    .assento.ocupado {
      background-color: #dc3545;
      cursor: not-allowed;
    }

    .assento.exemplo {
      pointer-events: none;
      margin-right: 5px;
    }

    .janela-selecao {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 250px;
      max-width: 90vw;
      background: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 15px;
      font-size: 14px;
      z-index: 9999;
      transform: translateZ(0);
    }

    .legenda {
      margin-top: 30px;
      display: flex;
      justify-content: center;
      gap: 20px;
      font-size: 14px;
      flex-wrap: wrap;
    }

    .legenda-item {
      display: flex;
      align-items: center;
    }

    .porta-entrada {
      margin-top: 10px;
      font-size: 13px;
      font-weight: bold;
      color: #555;
      text-align: left;
      padding-left: 5px;
    }

    @media (max-width: 768px) {
      .palco {
        width: 95%;
        font-size: 16px;
        padding: 10px 0;
      }

      .janela-selecao {
        bottom: 10px;
        right: 10px;
        width: 30vw;
        padding: 10px;
        font-size: 13px;
        max-height: 35vh;
        overflow-y: auto;
      }
    }
  </style>

  <h1><?= $musical["nome"] ?></h1>

  <div class="container-palco-e-auditorio">
    <div class="palco">PALCO</div>

    <div class="auditorio">
      <div class="grupo-esquerda">
        <?php
        $alfabeto = str_split(strtoupper("abcdefghijklmnopqrstuvwxyz"));
        for ($i = 0; $i < 20; $i++) {
          $fileira = $alfabeto[$i];
          echo '<div class="fileira">';
          echo "<div class='num-fileira'>$fileira</div>";
          for ($j = 1; $j <= 9; $j++) {
            foreach ($esquerda as $assento) {
              if ($assento[2] == $fileira && $assento[1] == $j) {
                $status = $assento[4];
                $id_assento = $fileira . $j;
                $classe = ($i < 3 ? 'assento vip' : 'assento');
                if ($status === 'ocupado') {
                  $classe .= ' ocupado';
                }
                $preco = $i < 3 ? 6 : 3;
                echo "<div class='$classe' data-id='$id_assento' data-preco='$preco'>$j</div>";
              }
            }
          }
          echo '</div>';
        }
        echo '<div class="porta-entrada">Porta de Entrada</div>';
        ?>
      </div>

      <div class="grupo-direita">
        <?php
        for ($i = 0; $i < 20; $i++) {
          $fileira = $alfabeto[$i];
          echo '<div class="fileira">';
          for ($j = 10; $j <= 15; $j++) {
            foreach ($direita as $assento) {
              if ($assento[2] == $fileira && $assento[1] == $j) {
                $status = $assento[4];
                $id_assento = $fileira . $j;
                $classe = ($i < 3 ? 'assento vip' : 'assento');
                if ($status === 'ocupado') {
                  $classe .= ' ocupado';
                }
                $preco = $i < 3 ? 6 : 3;
                echo "<div class='$classe' data-id='$id_assento' data-preco='$preco'>$j</div>";
              }
            }
          }
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </div>

  <div class="janela-selecao">
    <strong>Assentos selecionados:</strong><br>
    <div id="selecionados">(nenhum)</div>
    <p><strong>Total:</strong> R$<span id="total">0,00</span></p>
    <button onclick="continuarCompra()">Continuar para compra</button>
  </div>

  <div class="legenda">
    <span class="legenda-item"><span class="assento exemplo vip"></span> VIP (R$6,00)</span>
    <span class="legenda-item"><span class="assento exemplo"></span> Comum (R$3,00)</span>
    <span class="legenda-item"><span class="assento exemplo ocupado"></span> Ocupado</span>
    <span class="legenda-item"><span class="assento exemplo selecionado"></span> Selecionado</span>
  </div>

  <script>
  const selecionadosDiv = document.getElementById("selecionados");
  const totalSpan = document.getElementById("total");
  let selecionados = [];
  let total = 0;

  function atualizarResumo() {
    if (selecionados.length === 0) {
      selecionadosDiv.innerHTML = "(nenhum)";
    } else {
      selecionadosDiv.innerHTML = "<ul style='padding-left: 18px; margin: 0'>";
      selecionados.forEach(s => {
        selecionadosDiv.innerHTML += `<li>${s.id}</li>`;
      });
      selecionadosDiv.innerHTML += "</ul>";
    }
    totalSpan.textContent = total.toFixed(2).replace('.', ',');
  }

  function continuarCompra() {
    const assentosSelecionados = selecionados.map(s => s.id).join(',');
    const valorTotal = total.toFixed(2); // ponto decimal para WooCommerce

    fetch('/wp-json/custom/v1/adicionar-ingresso', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        assentos: assentosSelecionados,
        total: valorTotal
      })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        // Se quiser redirecionar direto ao checkout:
        window.location.href = '/checkout';
      } else {
        alert("Erro ao adicionar ao carrinho.");
        console.error("Resposta da API:", data);
      }
    })
    .catch(err => {
      console.error("Erro na requisição:", err);
      alert("Erro de comunicação com o servidor.");
    });
  }

  document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.assento').forEach(el => {
      if (!el.classList.contains("ocupado")) {
        el.addEventListener('click', () => {
          const id = el.dataset.id;
          const preco = parseFloat(el.dataset.preco);

          if (el.classList.contains("selecionado")) {
            el.classList.remove("selecionado");
            selecionados = selecionados.filter(s => s.id !== id);
            total -= preco;
          } else {
            el.classList.add("selecionado");
            selecionados.push({ id, preco });
            total += preco;
          }
          atualizarResumo();
        });
      }
    });
  });
</script>

</div>

<?php get_footer(); ?>
