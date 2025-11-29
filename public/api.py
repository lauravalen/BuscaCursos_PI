import requests
from bs4 import BeautifulSoup
import re

def extrair_cursos_da_url(url):
    
        response = requests.get(url)
        response.raise_for_status() 
        
        soup = BeautifulSoup(response.text, 'html.parser')
        
        urls_unicas = set()
        cursos_encontrados = []
        filtro_curso1='/course'
        filtro_curso2='/curso'
        filtro_curso3='/course/view.php?'

        from urllib.parse import urlparse, urljoin
        parsed_url = urlparse(url)
        dominio_base = f"{parsed_url.scheme}://{parsed_url.netloc}"
        
        # Encontrar todos os links
        for link in soup.find_all('a'):
            url_relativa = link.get('href')
            nome_curso = link.get_text().strip()
            
            if url_relativa and (filtro_curso1 or filtro_curso2 or filtro_curso3) in url_relativa and nome_curso and len(nome_curso) > 3:
                if url_relativa.startswith('http'):
                    url_completa = url_relativa
                else:
                    url_completa = urljoin(dominio_base, url_relativa)
                
                # Adicionar à lista se for única
                if url_completa not in urls_unicas:
                    urls_unicas.add(url_completa)
                    cursos_encontrados.append((nome_curso, url_completa))
        
        # Exibir resultados
        for nome_curso, url_completa in cursos_encontrados:
            print(f"Curso: {nome_curso}")
            print(f"URL: {url_completa}")                  
        return cursos_encontrados
        
    

url_input = input("Digite a URL para extrair cursos (ou pressione Enter para usar a URL padrão): ").strip()
        
cursos = extrair_cursos_da_url(url_input)
