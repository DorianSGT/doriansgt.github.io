from flask import Flask, render_template, jsonify, request
app = Flask(__name__)

estado_coche = {
    "encendido": False,
    "velocidad": 0,
    "intermitente_izq": False,
    "intermitente_der": False
}

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/estado', methods=['GET'])
def obtener_estado():
    return jsonify(estado_coche)

@app.route('/arrancar', methods=['POST'])
def arrancar():
    estado_coche['encendido'] = True
    return jsonify({"status": "encendido", "estado": estado_coche })

@app.route('/apagar', methods=['POST'])
def apagar():
    estado_coche['encendido'] = False
    estado_coche['velocidad'] = 0
    estado_coche['intermitente_izq'] = False
    estado_coche['intermitente_der'] = False
    return jsonify({"status": "apagado", "estado": estado_coche })

@app.route('/acelerar', methods=['POST'])
def acelerar():
    if estado_coche['encendido']:
        datos = request.json or {}
        n = int(datos.get('incremento', 10))
        
        nueva_velocidad = estado_coche['velocidad'] + n
        estado_coche['velocidad'] = min(250, nueva_velocidad)
        
        estado_coche['intermitente_izq'] = False
        estado_coche['intermitente_der'] = False
        return jsonify({"status": "acelerando", "estado": estado_coche })
    else:
        return jsonify({"status": "error", "message": "El coche está apagado", "estado": estado_coche })

@app.route('/frenar', methods=['POST'])
def frenar():
    if estado_coche['encendido']:
        datos = request.json or {}
        n = int(datos.get('incremento', 10))

        nueva_velocidad = estado_coche['velocidad'] - n
        estado_coche['velocidad'] = max(0, nueva_velocidad)
        estado_coche['intermitente_izq'] = False
        estado_coche['intermitente_der'] = False

        return jsonify({"status": "frenando", "estado": estado_coche })
    else:
        return jsonify({"status": "error", "message": "El coche está apagado", "estado": estado_coche })
    
@app.route('/girar_izq', methods=['POST'])
def girar_izq():
    if estado_coche['encendido']:
        estado_coche['intermitente_izq'] = True
        estado_coche['intermitente_der'] = False
        return jsonify({"status": "girando a la izquierda", "estado": estado_coche })    
    else:
        return jsonify({"status": "error", "mensaje": "El coche está apagado", "estado": estado_coche })

@app.route('/girar_der', methods=['POST'])
def girar_der():
    if estado_coche['encendido']:
        estado_coche['intermitente_izq'] = False
        estado_coche['intermitente_der'] = True
        return jsonify({"status": "girando a la derecha", "estado": estado_coche })    
    else:
        return jsonify({"status": "error", "mensaje": "El coche está apagado", "estado": estado_coche })

if __name__ == '__main__':
    app.run(debug=True)