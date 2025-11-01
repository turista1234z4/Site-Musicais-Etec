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
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $musical["nome"] ?> - Mapa de Assentos</title>
  <script>alert('Opa! Os assentos acabaram! Mas haverão mais asssentos disponíveis para compra no dia do evento. Não deixe de comparecer!')</script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
    }
    .container-geral {
    max-width: 500px; /* ou o tamanho máximo que quiser */
    margin: 0 auto;
    padding: 0 10px;
    box-sizing: border-box;
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
      flex-wrap: nowrap;
      overflow-x: scroll;
     gap: 50px;
    }
    @media (max-width: 768px) {
  .auditorio {
    margin: 0 1rem; /* menor margem */
    /* opcional: diminuir um pouco o tamanho dos assentos no mobile */
  }
}
@media (max-width: 768px) {
  .assento {
    width: 18px;
    height: 18px;
    font-size: 10px;
    line-height: 18px;
  }
  .num-fileira {
    width: 15px;
    line-height: 18px;
    font-size: 12px;
  }
}
.navbar {
  width: 100%;
  max-width: 100vw;
  overflow-x: auto; /* permite rolagem horizontal caso precise */
}


    .grupo-esquerda,
    .grupo-direita {
      display: flex;
      flex-direction: column;
      margin-left: 0 5rem;
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
    @media (max-width: 768px) {
  .assento {
    width: 18px;
    height: 18px;
    font-size: 10px;
    line-height: 18px;
  }
  .num-fileira {
    width: 15px;
    line-height: 18px;
    font-size: 12px;
  }
  
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
</head>

<body>
 <div class="container-geral">
  <h1><?= $musical["nome"] ?></h1>
    <div class="aviso-assentos">
    ⚠️ <strong>Atenção:</strong> <p>Só prossiga para compra quando tiver certeza dos assentos escolhidos!!</p>
</div>

<style>
.aviso-assentos {
    background-color: #fff3cd; /* amarelo claro */
    color: #856404; /* marrom escuro para contraste */
    padding: 15px;
    border: 1px solid #ffeeba;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: Arial, sans-serif;
}
.aviso-assentos p{
    color: black;
}

</style>
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
                $id_assento = $assento[2] . $assento[1];
                $classe = ($i < 3 ? 'assento vip' : 'assento');
                if ($status === 'ocupado' || $status === "reservado") {
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
                $id_assento = $assento[2] . $assento[1];
                $classe = ($i < 3 ? 'assento vip' : 'assento');
                if ($status === 'ocupado' || $status === "reservado") {
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
  <?php if ($musical_id == 2): ?>
    <span class="legenda-item"><span class="assento exemplo vip"></span> VIP (esgotado)</span>
    <span class="legenda-item"><span class="assento exemplo"></span> Comum (R$6,00)</span>
  <?php else: ?>
    <span class="legenda-item"><span class="assento exemplo vip"></span> VIP (R$6,00)</span>
    <span class="legenda-item"><span class="assento exemplo"></span> Comum (R$3,00)</span>
  <?php endif; ?>

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

  const musicalId = <?= json_encode($musical_id) ?>;

  function continuarCompra() {
    const assentosSelecionados = selecionados.map(s => s.id).join(',');
    const valorTotal = total.toFixed(2); // ponto decimal para WooCommerce
    const codigoPagamento = document.getElementById("codigoPagamento")?.value || ""; 

    fetch('/wp-json/custom/v1/adicionar-ingresso', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        assentos: assentosSelecionados,
        total: valorTotal,
        musical_id: musicalId,
        codigo: codigoPagamento // envia o código junto
      })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        // Se o backend retornar redirect (caso seja venda em dinheiro), usa ele
        if (data.redirect) {
          window.location.href = data.redirect;
        } else {
          // fluxo normal
          window.location.href = `/carrinho?musical_id=${musicalId}`;
        }
      } else {
        alert("Erro ao adicionar ao carrinho: " + (data.message || 'erro desconhecido'));
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
          let preco;
            const fileira = id.charAt(0).toUpperCase();
        if (musicalId == 2) {
              preco = 6.00; // todos custam 6
        } else {
             preco = (['A','B','C'].includes(fileira)) ? 6.00 : 3.00;
    }


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
<div style="
    background-color: #fff3cd;
    border: 1px solid #ffeeba;
    color: #856404;
    padding: 15px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    font-size: 16px;
    margin-bottom: 15px;
">
    <span style="font-size: 20px; margin-right: 10px;">⚠️</span>
    Atenção: assentos reservados poderão ser liberados automaticamente conforme pagamentos não sejam concluídos.
</div>

</div>
</body>

</html>