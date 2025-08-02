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
    alert("Você selecionou:\n" + selecionados.map(s => s.id).join(', ') + "\nTotal: R$ " + total.toFixed(2).replace('.', ','));
    // Aqui você pode redirecionar ou integrar com pagamento
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
