import cv2
img = cv2.imread("D:/test.png")
x = float(input("Nhập tỉ lệ thu phóng ảnh: "))
resizeImg = cv2.resize(img, None, fx=x, fy=x)
cv2.imshow("Original", img)
cv2.imshow("Resized", resizeImg)
cv2.waitKey(0)
cv2.destroyAllWindows()