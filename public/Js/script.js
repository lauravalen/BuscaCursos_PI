 const carrosseis = document.querySelectorAll('.curso .carrossel');
        carrosseis.forEach(carrossel => {
            let scrollPosition = 0;
            const itemWidth = 200;
            const totalItems = carrossel.children.length;

            function deslizar() {
                scrollPosition -= 1; // Velocidade do deslize
                if (Math.abs(scrollPosition) >= itemWidth * totalItems) {
                    scrollPosition = 0;
                }
                carrossel.style.transform = `translateX(${scrollPosition}px)`;
            }

            setInterval(deslizar, 30);
        });

    // -- barras de pesquisas -- //

        barraDeBusca.addEventListener('input', async function () {
        const texto = barraDeBusca.value.trim();

            if (texto.length < 2) { 
                sugestoesContainer.style.display = 'none';
                sugestoesContainer.innerHTML = '';
                return;
            }

            const resposta = await fetch(`/cursos/buscar?q=${texto}`);
            const sugestoes = await resposta.json();

            sugestoesContainer.innerHTML = '';

            if (sugestoes.length > 0) {
                sugestoesContainer.style.display = 'block';

                sugestoes.forEach(s => {
                    const div = document.createElement('div');
                    div.classList.add('sugestao');
                    div.textContent = s;

                    div.addEventListener('click', () => {
                        barraDeBusca.value = s;
                        sugestoesContainer.innerHTML = '';
                        sugestoesContainer.style.display = 'none';
                        document.getElementById('formBusca').submit();
                    });

                    sugestoesContainer.appendChild(div);
                });
            } else {
                sugestoesContainer.style.display = 'none';
            }
        });


// -- MODAL - page curso --//

const modal = document.getElementById("modalCurso");
const btns = document.querySelectorAll(".avaliacao");
const closeBtn = document.querySelector(".close-modal");

btns.forEach(btn => {
    btn.addEventListener("click", function(e) {
        e.preventDefault();

        let id = this.dataset.id;

        document.getElementById("modalTitulo").innerText = this.dataset.titulo;
        document.getElementById("modalDescricao").innerText = this.dataset.descricao;
        document.getElementById("cursoIdFeedback").value = id;

        modal.style.display = "flex";

        carregarFeedbacks(id);
    });
});

closeBtn.onclick = () => modal.style.display = "none";
window.onclick = e => { if (e.target === modal) modal.style.display = "none"; };

function carregarFeedbacks(id) {
    fetch(`/cursos/${id}/feedbacks`)
        .then(res => res.json())
        .then(data => {
            let div = document.getElementById("listaFeedbacks");

            if (data.feedbacks.length === 0) {
                div.innerHTML = "<p>Nenhum feedback ainda.</p>";
                return;
            }

            div.innerHTML = data.feedbacks.map(f => `
                <div style="margin-bottom:12px;">
                    <strong>${f.usuario}</strong>
                    <p>${f.texto}</p>
                </div>
            `).join("");

            document.getElementById("modalAvaliacao").innerText =
                data.avaliacao ? data.avaliacao + "/5" : "Sem avaliações";
        });
}

document.getElementById("formFeedback")?.addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("/feedbacks/salvar", {
        method: "POST",
        body: formData
    })
    .then(r => r.json())
    .then(res => {
        alert(res.message);
        carregarFeedbacks(formData.get("curso_id"));
        this.reset();
    });
});

