# compare_faces.py
import face_recognition
import sys

if len(sys.argv) != 3:
    print("Usage: compare_faces.py registered.jpg login.jpg")
    sys.exit(1)

# reg_img = face_recognition.load_image_file(sys.argv[1])
# login_img = face_recognition.load_image_file(sys.argv[2])

# reg_enc = face_recognition.face_encodings(reg_img)
# login_enc = face_recognition.face_encodings(login_img)

# if len(reg_enc) == 0 or len(login_enc) == 0:
#     print("Face not detected.")
#     sys.exit(0)

# match = face_recognition.compare_faces([reg_enc[0]], login_enc[0])[0]

# print("Match" if match else "No Match")
