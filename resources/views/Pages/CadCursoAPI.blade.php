<?php
// index.php
session_start();

// Criar conexão
$conn = new mysqli(
    "localhost",
    "root",
    "", 
    "BUSCA_CURSOS"
);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processar salvamento se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar_cursos'])) {
    salvarCursosNoBanco($conn, $_POST['cursos']);
}

function salvarCursosNoBanco($conn, $cursos) {
    $cursos_salvos = 0;
    $erros = 0;
    
    foreach ($cursos as $curso) {
        $url = $conn->real_escape_string($curso['url']);
        $nome = $conn->real_escape_string($curso['nome']);
        $area_conhecimento = $conn->real_escape_string($curso['area_conhecimento']);
        $carga_horaria = $conn->real_escape_string($curso['carga_horaria']);
        $nivel_ensino = $conn->real_escape_string($curso['nivel_ensino']);
        $data_insercao = date('Y-m-d H:i:s');
        $certificado = $conn->real_escape_string($curso['certificado']); 
        
        // Verificar se a categoria já existe
        $categoria_id = obterOuCriarCategoria($conn, $area_conhecimento);
        
        // Verificar se a área da categoria já existe
        $area_categoria_id = obterOuCriarAreaCategoria($conn, $categoria_id);
        
        // Inserir o curso
        $sql_curso = "INSERT INTO curso (
            area_categoria_id, 
            titulo_curso, 
            url_curso, 
            certificacao, 
            quantidade_horas, 
            descricao_curso, 
            data_inicio, 
            nivel_ensino, 
            data_insercao
        ) VALUES (
            '$area_categoria_id',
            '$nome',
            '$url',
            '$certificado',
            '$carga_horaria',
            'Curso online sobre $area_conhecimento',
            '$data_insercao',
            '$nivel_ensino',
            '$data_insercao'
        )";
        
        if ($conn->query($sql_curso) === TRUE) {
            $curso_id = $conn->insert_id;
            
            // Inserir na plataforma_curso
            $sql_plataforma_curso = "INSERT INTO plataforma_curso (curso_id, plataforma_id) VALUES ('$curso_id', 1)";
            if ($conn->query($sql_plataforma_curso)) {
                $cursos_salvos++;
            } else {
                $erros++;
            }
        } else {
            $erros++;
        }
    }
    
    $_SESSION['mensagem'] = "Sucesso: $cursos_salvos cursos salvos no banco de dados. Erros: $erros";
}

function obterOuCriarCategoria($conn, $descricao) {
    $descricao_escape = $conn->real_escape_string($descricao);
    
    $sql = "SELECT categoria_id FROM categoria WHERE descricao = '$descricao_escape'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['categoria_id'];
    } else {
        $data_insercao = date('Y-m-d H:i:s');
        $sql_insert = "INSERT INTO categoria (descricao, data_insercao) VALUES ('$descricao_escape', '$data_insercao')";
        
        if ($conn->query($sql_insert) === TRUE) {
            return $conn->insert_id;
        } else {
            return 1;
        }
    }
}

function obterOuCriarAreaCategoria($conn, $categoria_id) {
    $sql = "SELECT area_categoria_id FROM area_categoria WHERE categoria_id = '$categoria_id' AND situacao = 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['area_categoria_id'];
    } else {
        $data_insercao = date('Y-m-d H:i:s');
        $sql_insert = "INSERT INTO area_categoria (categoria_id, data_insercao, situacao) VALUES ('$categoria_id', '$data_insercao', 1)";
        
        if ($conn->query($sql_insert) === TRUE) {
            return $conn->insert_id;
        } else {
            return 1;
        }
    }
}
?>

   
@include('includes.headerAdm')
    <div class="container">
        <h1>🔍 Buscador de Cursos Online</h1>
    
        <form id="buscarForm">
            <div class="form-group">
                <label for="url">URL do Site:</label>
                <input type="text" id="url" name="url" placeholder="https://exemplo.com" required>
            </div>
            
            <div class="form-group">
                <label for="filtro_url">Filtro de URL:</label>
                <select id="filtro_url" name="filtro_url" required>
                    <option value="">Selecione um filtro...</option>
                    <option value="course/view.php?id=">course/view.php?id=</option>
                    <option value="cursos">cursos</option>
                    <option value="">Sem filtro</option>
                    <option value="/course.action">/course.action</option>
                </select>
                <small>Selecione o filtro apropriado para a plataforma</small>
            </div>
            
            <div class="form-group">
                <label for="area_conhecimento">Área de Conhecimento (opcional):</label>
                <input type="text" id="area_conhecimento" name="area_conhecimento" placeholder="programação, matemática, etc.">
            </div>
            
            <button type="submit" id="buscarBtn">Buscar Cursos</button>
        </form>
        
        <div class="loading" id="loading">
            🔍 Buscando cursos... Aguarde!
        </div>
        
        <div class="error" id="error"></div>
        
        <div class="results-info" id="resultsInfo"></div>
        
        <form id="formSalvar" method="POST" action="">
            <input type="hidden" name="salvar_cursos" value="1">
            <table id="cursosTable">
                <thead>
                    <tr>
                        <th>Nome do Curso</th>
                        <th>URL</th>
                        <th>Área de Conhecimento</th>
                        <th>Carga Horária</th>
                        <th>Nível de Ensino</th>
                    </tr>
                </thead>
                <tbody id="cursosTbody">
                    <!-- Os cursos serão inseridos aqui via JavaScript -->
                </tbody>
            </table>

            <div class="actions" id="actions" style="display: none;">
                <button type="submit" class="btn-save">Salvar no Banco de Dados</button>
                <button type="button" onclick="exportarParaCSV()">Exportar para CSV</button>
            </div>
        </form>
    </div>

    <script>
        // Lista de áreas de conhecimento pré-definidas
        const areasConhecimento = [
            "Programação ",
            "Banco de Dados",
            "Gestão e Negócios", 
            "Design e Ilustração",
            "Inteligência Artificial",
            "Saúde",
            "Marketing",
            "Línguas Estrangeiras",
            "Outra"
        ];

        // Lista de cargas horárias
        const cargasHorarias = [
            {value: "5", text: "5 horas"},
            {value: "30", text: "30 horas"},
            {value: "40", text: "40 horas"},
            {value: "60", text: "60 horas"},
            {value: "80", text: "80 horas"},
            {value: "100", text: "100 horas"},
            {value: "200", text: "200 horas"}
        ];

        // Lista de níveis de ensino
        const niveisEnsino = [
            "Iniciante",
            "Básico",
            "Intermediário",
            "Avançado"
        ];

        document.addEventListener('DOMContentLoaded', function() {
            // Configurar filtro padrão
            document.getElementById('filtro_url').value = 'course/view.php?id=';
        });

        function popularSelectAreas(selectElement) {
            selectElement.innerHTML = '';
            
            areasConhecimento.forEach(area => {
                const option = document.createElement('option');
                option.value = area;
                option.textContent = area;
                selectElement.appendChild(option);
            });
        }

        function popularSelectCargaHoraria(selectElement) {
            selectElement.innerHTML = '';
            
            cargasHorarias.forEach(carga => {
                const option = document.createElement('option');
                option.value = carga.value;
                option.textContent = carga.text;
                selectElement.appendChild(option);
            });
        }

        function popularSelectNivelEnsino(selectElement) {
            selectElement.innerHTML = '';
            
            niveisEnsino.forEach(nivel => {
                const option = document.createElement('option');
                option.value = nivel;
                option.textContent = nivel;
                selectElement.appendChild(option);
            });
        }

        document.getElementById('buscarForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const buscarBtn = document.getElementById('buscarBtn');
            const loading = document.getElementById('loading');
            const errorDiv = document.getElementById('error');
            const resultsInfo = document.getElementById('resultsInfo');
            const cursosTable = document.getElementById('cursosTable');
            const cursosTbody = document.getElementById('cursosTbody');
            const actions = document.getElementById('actions');
            
            // RESET
            buscarBtn.disabled = true;
            loading.style.display = 'block';
            errorDiv.style.display = 'none';
            resultsInfo.style.display = 'none';
            cursosTable.style.display = 'none';
            actions.style.display = 'none';
            cursosTbody.innerHTML = '';
            
            const formData = {
                url: document.getElementById('url').value,
                filtro_url: document.getElementById('filtro_url').value,
                area_conhecimento: document.getElementById('area_conhecimento').value
            };
            
            try {
                const response = await fetch('http://localhost:5000/buscar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData)
                });
                
                const data = await response.json();
                
                if (data.success) {
                    if (data.cursos && data.cursos.length > 0) {
                        // Tabela
                        data.cursos.forEach(curso => {
                            const row = document.createElement('tr');
                            
                            // Coluna Nome
                            const nomeCell = document.createElement('td');
                            nomeCell.textContent = curso.nome;
                            
                            // Coluna URL
                            const urlCell = document.createElement('td');
                            const link = document.createElement('a');
                            link.href = curso.url;
                            link.textContent = curso.url.length > 50 ? curso.url.substring(0, 50) + '...' : curso.url;
                            link.className = 'curso-link';
                            link.target = '_blank';
                            link.title = curso.url;
                            urlCell.appendChild(link);
                            
                            // Coluna Área de Conhecimento
                            const areaCell = document.createElement('td');
                            const selectArea = document.createElement('select');
                            selectArea.className = 'area-select';
                            selectArea.name = 'cursos[][area_conhecimento]';
                            selectArea.required = true;
                            
                            // Coluna Carga Horária
                            const cargaCell = document.createElement('td');
                            const selectCarga = document.createElement('select');
                            selectCarga.className = 'carga-select';
                            selectCarga.name = 'cursos[][carga_horaria]';
                            selectCarga.required = true;
                            
                            // Coluna Nível de Ensino
                            const nivelCell = document.createElement('td');
                            const selectNivel = document.createElement('select');
                            selectNivel.className = 'nivel-select';
                            selectNivel.name = 'cursos[][nivel_ensino]';
                            selectNivel.required = true;
                            
                            // Adicionar campos hidden para nome e URL
                            const inputNome = document.createElement('input');
                            inputNome.type = 'hidden';
                            inputNome.name = 'cursos[][nome]';
                            inputNome.value = curso.nome;
                            
                            const inputUrl = document.createElement('input');
                            inputUrl.type = 'hidden';
                            inputUrl.name = 'cursos[][url]';
                            inputUrl.value = curso.url;
                            
                            // Popular os selects
                            popularSelectAreas(selectArea);
                            popularSelectCargaHoraria(selectCarga);
                            popularSelectNivelEnsino(selectNivel);
                            
                            areaCell.appendChild(selectArea);
                            areaCell.appendChild(inputNome);
                            areaCell.appendChild(inputUrl);
                            
                            cargaCell.appendChild(selectCarga);
                            nivelCell.appendChild(selectNivel);
                            
                            row.appendChild(nomeCell);
                            row.appendChild(urlCell);
                            row.appendChild(areaCell);
                            row.appendChild(cargaCell);
                            row.appendChild(nivelCell);
                            cursosTbody.appendChild(row);
                        });
                        
                        // Mostrar informações
                        resultsInfo.textContent = `Foram encontrados ${data.total} curso(s)`;
                        resultsInfo.style.display = 'block';
                        cursosTable.style.display = 'table';
                        actions.style.display = 'flex';
                    } else {
                        errorDiv.textContent = 'Nenhum curso encontrado com os filtros especificados.';
                        errorDiv.style.display = 'block';
                    }
                } else {
                    errorDiv.textContent = `Erro na API: ${data.error}`;
                    errorDiv.style.display = 'block';
                }
                
            } catch (error) {
                errorDiv.textContent = `Erro ao conectar com a API: ${error.message}. Verifique se a API Python está rodando.`;
                errorDiv.style.display = 'block';
            } finally {
                buscarBtn.disabled = false;
                loading.style.display = 'none';
            }
        });

        /*function exportarParaCSV() {
            const rows = document.querySelectorAll('#cursosTbody tr');
            let csvContent = "Nome do Curso,URL,Área de Conhecimento,Carga Horária,Nível de Ensino\n";
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const nome = cells[0].textContent.replace(/,/g, ';');
                const url = cells[1].querySelector('a').href;
                const area = cells[2].querySelector('select').value;
                const carga = cells[3].querySelector('select').value;
                const nivel = cells[4].querySelector('select').value;
                
                csvContent += `"${nome}","${url}","${area}","${carga}","${nivel}"\n`;
            });
            
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.setAttribute('hidden', '');
            a.setAttribute('href', url);
            a.setAttribute('download', 'cursos_classificados.csv');
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }*/
    </script>
@include('includes.footer')

<?php
// Fechar conexão
$conn->close();
?>
