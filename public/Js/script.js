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

        // plataformas vindas do botão
        const plataformas = JSON.parse(this.dataset.plataformas);
        const divPlataforma = document.getElementById("modalPlataforma");

        if (plataformas.length > 0) {
            divPlataforma.innerHTML = 
                "<strong>Plataforma:</strong> " + 
                plataformas.map(p => `<span>${p}</span>`).join(", ");
        } else {
            divPlataforma.innerHTML = "<strong>Plataforma:</strong> Não informado";
        }

        modal.style.display = "flex";

        carregarFeedbacks(id);
    });
});

closeBtn.onclick = () => modal.style.display = "none";
window.onclick = e => { if (e.target === modal) modal.style.display = "none"; };


// --------- CARREGA FEEDBACKS + AVALIAÇÃO MÉDIA ---------- //

function carregarFeedbacks(id) {
    fetch(`/cursos/${id}/feedbacks`)
        .then(res => res.json())
        .then(data => {
            let div = document.getElementById("listaFeedbacks");

            if (data.feedbacks.length === 0) {
                div.innerHTML = "<p>Nenhum feedback ainda.</p>";
            } else {
                div.innerHTML = data.feedbacks.map(f => `
                    <div class="comentarioUsers">
                        <div class="row-comentariouser">
                            <p style="color: #00145A;font-size:14px;font-weight:bold;margin-top:0.3rem">@${f.usuario}:</p>
                            <div class="user-stars">
                                ${'★'.repeat(f.nota)}${'☆'.repeat(5 - f.nota)}
                            </div>
                        </div>
                        <p>${f.texto}</p>
                    </div>
                `).join("");
            }

            const media = Number(data.avaliacao);
            const estrelasCheias = '★'.repeat(Math.round(media));
            const estrelasVazias = '☆'.repeat(5 - Math.round(media));

            document.getElementById("modalAvaliacaoMedia").innerHTML =
                media
                    ? `<strong></strong> ${media} ${estrelasCheias}${estrelasVazias}`
                    : "<strong></strong> 0.0 ☆☆☆☆☆";
        });

}


// --------- SALVAR FEEDBACK ---------- //

document.getElementById("formFeedback")?.addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("/feedbacks/salvar", {
        method: "POST",
        body: formData
    })
    .then(r => r.json().then(data => ({ status: r.status, body: data })))
    .then(res => {

        if (res.status === 401) {
            alert("Você precisa estar logada para comentar!");
            return;
        }

        alert("Comentário enviado com sucesso!");

        carregarFeedbacks(formData.get("curso_id"));
        this.reset();
    });
});
