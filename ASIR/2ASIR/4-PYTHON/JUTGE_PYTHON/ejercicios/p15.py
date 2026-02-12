import sys

tokens = sys.stdin.read().split()

for i in range(0, len(tokens), 4):
    
    if i + 3 >= len(tokens):
        break

    a1 = int(tokens[i])
    b1 = int(tokens[i+1])
    a2 = int(tokens[i+2])
    b2 = int(tokens[i+3])

    relacion = "?"
    
    if a1 == a2 and b1 == b2:
        relacion = "="
    elif a2 <= a1 and b1 <= b2:
        relacion = "1"
    elif a1 <= a2 and b2 <= b1:
        relacion = "2"

    inicio_intersec = max(a1, a2)
    final_intersec = min(b1, b2)
    
    interseccion = ""
    if inicio_intersec > final_intersec:
        interseccion = "[]"
    else:
        interseccion = f"[{inicio_intersec},{final_intersec}]"

    print(f"{relacion} , {interseccion}")