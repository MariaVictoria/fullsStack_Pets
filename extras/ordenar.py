import os
from gitignore_parser import parse_gitignore

def guardar_archivos_y_carpetas(directorio, archivo_salida):
    # Verificar si existe el archivo .gitignore
    gitignore_path = os.path.join(directorio, '.gitignore')
    if os.path.exists(gitignore_path):
        # Leer el contenido del archivo .gitignore
        with open(gitignore_path, 'r') as gitignore_file:
            gitignore_rules = gitignore_file.read()
        # Crear el parser de .gitignore
        gitignore = parse_gitignore(gitignore_rules)
    else:
        # Si no existe el archivo .gitignore, crear un parser vacío
        gitignore = lambda x: False  # Retorna False para todos los archivos

    # Agregar regla para ignorar la carpeta .git, myvenv y todos sus contenidos
    gitignore_patterns = ['.git', '.git/*', 'myvenv', 'myvenv/*']

    # Escribir la organización de archivos y carpetas
    with open(archivo_salida, 'w') as archivo:
        for ruta_directorio, carpetas, archivos in os.walk(directorio):
            # Convertir la ruta absoluta a relativa
            ruta_relativa = os.path.relpath(ruta_directorio, directorio)
            
            # Si la carpeta .git o myvenv está presente en la ruta relativa, omitirla
            if any(pattern in ruta_relativa.split(os.sep) for pattern in gitignore_patterns):
                continue
            
            archivo.write(f"En {ruta_relativa}:\n")
            
            for carpeta in carpetas:
                if not gitignore(os.path.join(ruta_relativa, carpeta)):
                    archivo.write(f"- Carpeta: {carpeta}\n")
            
            for nombre_archivo in archivos:
                if not gitignore(os.path.join(ruta_relativa, nombre_archivo)):
                    archivo.write(f"- Archivo: {nombre_archivo}\n")

# Llamar a la función para guardar la organización en el directorio actual
guardar_archivos_y_carpetas('.', 'organizacion.txt')
