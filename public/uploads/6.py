import cv2
img = cv2.imread("D:/test.png")
cv2.namedWindow("Display")
x, y = 1, 1
def get_brightness(pos):
    global x
    x = pos
def get_contrast(pos):
    global y
    y = pos
cv2.createTrackbar("Brightness", "Display", 0, 255, get_brightness)
cv2.createTrackbar("Contrast", "Display", 0, 70, get_contrast)
while True:
    # alpha=y/10 -> giá trị của contrast từ 0 đến 7, tăng mỗi đơn vị tương ứng với 0.1
    new = cv2.convertScaleAbs(img, alpha=y/10, beta=x)
    cv2.imshow("Display", new)
    if (cv2.waitKey(10)) == ord('q'): break
cv2.destroyAllWindows()