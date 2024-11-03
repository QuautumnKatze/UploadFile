import cv2
img = cv2.imread("D:/test.png")
cv2.imshow("display", img)
cv2.waitKey(0)
cv2.destroyAllWindows()
x = int(input("Nhập tọa độ x: "))
y = int(input("Nhập tọa độ y: "))
(b, g, r) = img[y, x]
print("Giá trị màu tại điểm ảnh (", x, ",", y, "):")
print("Blue:", b)
print("Green:", g)
print("Red:", r)