import cv2
img = cv2.imread("D:/test.png")
h, w = img.shape[:2]
crop = img[0:int(h/2), 0:int(w/2)]
crop1p5 =  cv2.resize(crop, None, fx=1.5, fy=1.5)
cv2.imshow("display", crop1p5)
cv2.waitKey(0)
cv2.destroyAllWindows()
cv2.imwrite("savedBai4.png", crop)