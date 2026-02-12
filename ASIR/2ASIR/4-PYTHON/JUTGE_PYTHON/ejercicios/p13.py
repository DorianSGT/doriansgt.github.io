import sys

# Usamos la logica de que el inicio de la interseccion es el maximo de el primer y tercer numero
# Y que el final de la interseccion es el minimo del segundo y ultimo numero

tokens = sys.stdin.read().split()
if len(tokens) < 4:
    sys.exit(0)

a1 = int(tokens[0])
b1 = int(tokens[1])
a2 = int(tokens[2])
b2 = int(tokens[3])

inicio_intersec = max(a1, a2)
final_intersec= min(b1, b2)

if inicio_intersec <= final_intersec:
    print(f"[{inicio_intersec},{final_intersec}]")
else:
    print("[]")